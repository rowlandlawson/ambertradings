<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;

class ChatController extends Controller
{
    // List of available models
    private $availableModels = [
        'flash' => 'gemini-1.5-flash-latest',    // Fast, efficient
        'pro' => 'gemini-1.5-pro-latest',        // More capable
        'pro-legacy' => 'gemini-1.0-pro-latest', // Legacy version
    ];
    
    public function sendMessage(Request $request)
    {
        $request->validate([
            'message' => 'required|string',
            'model' => 'sometimes|string|in:flash,pro,pro-legacy', // Optional model selection
        ]);

        $message = $request->input('message');
        $modelType = $request->input('model', 'pro'); // Default to 'pro'
        $modelName = $this->availableModels[$modelType] ?? $this->availableModels['pro'];
        
        $apiKey = env('GEMINI_API_KEY');

        if (!$apiKey) {
            return response()->json([
                'error' => 'API Key not configured. Please check your .env file.',
                'debug' => [
                    'key_exists' => !empty($apiKey),
                    'key_length' => strlen($apiKey),
                ]
            ], 500);
        }

        // System Context for Amber Trading
        $systemPrompt = <<<EOT
        You are the helpful, professional AI Customer Support Agent for 'Amber Tradings' (AmberTrading). 
        
        ABOUT AMBER TRADING:
        - We are a global leader in online financial trading & investment, serving clients in over 150 countries.
        - We are fully regulated, licensed, and authorized.
        - We offer 'Best Execution Policies', 'ICF Protection' (Investor Compensation Fund), and 'Segregated Client Funds'.
        - Our stats are verified by PwC (PricewaterhouseCoopers).
        
        SERVICES & INSTRUMENTS:
        - Forex (Major, minor, exotic pairs)
        - Cryptocurrencies (Bitcoin, Ethereum, etc.)
        - Commodities (Gold, Silver, Oil)
        - Indices (S&P 500, NASDAQ)
        - CFD Stocks (Shares of global companies)
        - NFP Trading (Non-Farm Payroll)
        
        KEY BENEFITS:
        - Fast execution (<12 mins approval, rapid order execution).
        - Tight spreads (from 0.1 pips).
        - 24/5 Customer Support.
        - MetaTrader 4 & 5 platforms.
        - 5-Tier Loyalty Programme for professional clients.
        
        YOUR ROLE:
        - **IMPORTANT: ANSWER THE USER'S QUESTION DIRECTLY AND IMMEDIATELY.**
        - Do not start with pleasantries like 'Thank you for asking' or 'I can help with that' unless necessary.
        - Be extremely concise. Get straight to the point.
        - Only provide extra details if explicitly asked.
        - If asked about registration -> link '/register'.
        - If asked about login -> link '/login'.
        - If asked about support -> link '/contact'.
        
        USER MESSAGE:
        $message
        EOT;

        try {
            // Correct URL format
            $url = "https://generativelanguage.googleapis.com/v1beta/models/gemini-flash-latest:generateContent?key={$apiKey}";
            
            Log::info("Using model: gemini-flash-latest");
            Log::info("Request URL: " . $url);

            $response = Http::withoutVerifying()->withHeaders([
                'Content-Type' => 'application/json',
            ])->post($url, [
                'contents' => [
                    [
                        'parts' => [
                            ['text' => $systemPrompt]
                        ]
                    ]
                ],
                'generationConfig' => [
                    'temperature' => 0.7,
                    'topK' => 40,
                    'topP' => 0.95,
                    'maxOutputTokens' => 1024,
                ]
            ]);

            Log::info('API Response Status: ' . $response->status());

            if ($response->successful()) {
                $data = $response->json();
                
                // Check for safety blocks
                if (isset($data['promptFeedback']['blockReason'])) {
                    return response()->json([
                        'error' => 'Message was blocked for safety reasons',
                        'blockReason' => $data['promptFeedback']['blockReason']
                    ], 400);
                }
                
                if (isset($data['candidates'][0]['content']['parts'][0]['text'])) {
                    $botReply = $data['candidates'][0]['content']['parts'][0]['text'];
                    return response()->json([
                        'reply' => $botReply,
                        'model' => $modelName,
                        'usage' => $data['usageMetadata'] ?? null
                    ]);
                } else {
                    Log::error('Unexpected API response structure', $data);
                    return response()->json([
                        'error' => 'Unexpected response from AI service',
                        'response' => $data
                    ], 500);
                }
            } else {
                $errorData = $response->json();
                Log::error('Gemini API Error', [
                    'status' => $response->status(),
                    'error' => $errorData,
                    'model' => $modelName
                ]);
                
                return response()->json([
                    'error' => 'API Error: ' . ($errorData['error']['message'] ?? 'Unknown error'),
                    'code' => $errorData['error']['code'] ?? $response->status(),
                    'model' => $modelName,
                    'suggestion' => 'Try a different model or check API key permissions'
                ], $response->status());
            }

        } catch (\Exception $e) {
            Log::error('Chat Controller Exception', [
                'message' => $e->getMessage(),
                'trace' => $e->getTraceAsString()
            ]);
            
            return response()->json([
                'error' => 'Internal server error',
                'message' => $e->getMessage()
            ], 500);
        }
    }
    
    /**
     * Test endpoint to verify API key and list available models
     */
    public function testConnection(Request $request)
    {
        $apiKey = env('GEMINI_API_KEY');
        
        if (!$apiKey) {
            return response()->json([
                'success' => false,
                'message' => 'API key not configured in .env file',
                'key_exists' => false
            ], 500);
        }
        
        try {
            // Test with a simple request
            $url = "https://generativelanguage.googleapis.com/v1beta/models/gemini-1.5-flash-latest:generateContent?key={$apiKey}";
            
            $response = Http::timeout(10)->post($url, [
                'contents' => [
                    [
                        'parts' => [
                            ['text' => 'Hello']
                        ]
                    ]
                ]
            ]);
            
            return response()->json([
                'success' => $response->successful(),
                'status' => $response->status(),
                'api_key_valid' => $response->successful(),
                'available_models' => array_values($this->availableModels),
                'current_key' => substr($apiKey, 0, 10) . '...' . substr($apiKey, -4)
            ]);
            
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Connection failed',
                'error' => $e->getMessage(),
                'api_key_exists' => true
            ], 500);
        }
    }
}
