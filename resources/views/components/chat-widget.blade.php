<div id="ai-chat-widget" class="fixed bottom-6 right-6 z-1000 font-sans">
    <!-- Chat Toggle Button -->
    <button id="chat-toggle" class="bg-gradient-to-r from-orange-500 to-red-500 hover:from-orange-600 hover:to-red-600 text-white rounded-full p-4 shadow-lg transition-all duration-300 transform hover:scale-105 flex items-center justify-center">
        <svg xmlns="http://www.w3.org/2000/svg" class="h-8 w-8" fill="none" viewBox="0 0 24 24" stroke="currentColor">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 10h.01M12 10h.01M16 10h.01M9 16H5a2 2 0 01-2-2V6a2 2 0 012-2h14a2 2 0 012 2v8a2 2 0 01-2 2h-5l-5 5v-5z" />
        </svg>
    </button>

    <!-- Chat Window -->
    <div id="chat-window" class="hidden absolute bottom-20 right-0 w-80 md:w-96 bg-white dark:bg-slate-800 rounded-2xl shadow-2xl overflow-hidden border border-slate-200 dark:border-slate-700 transition-all duration-300 origin-bottom-right transform scale-95 opacity-0">
        <!-- Header -->
        <div class="bg-gradient-to-r from-orange-500 to-red-500 p-4 flex justify-between items-center text-white">
            <div class="flex items-center gap-2">
                <div class="w-2 h-2 bg-green-400 rounded-full animate-pulse"></div>
                <h3 class="font-bold text-lg">Amtradings Assistant</h3>
            </div>
            <button id="chat-close" class="hover:text-slate-200 transition-colors">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                </svg>
            </button>
        </div>

        <!-- Messages Area -->
        <div id="chat-messages" class="h-80 overflow-y-auto p-4 bg-slate-50 dark:bg-slate-900 space-y-4">
            <!-- Intro Message -->
            <div class="flex items-start gap-2.5">
                <div class="w-8 h-8 rounded-full bg-gradient-to-br from-orange-500 to-red-500 flex items-center justify-center text-white text-xs font-bold shrink-0">
                    AI
                </div>
                <div class="flex flex-col w-full max-w-[320px] leading-1.5 p-4 border-gray-200 bg-white rounded-e-xl rounded-es-xl dark:bg-slate-800 dark:border-slate-700 shadow-sm">
                   <p class="text-sm font-normal text-slate-800 dark:text-slate-200">Hello! I'm your AI assistant. How can I help you today?</p>
                </div>
            </div>
        </div>

        <!-- Input Area -->
        <div class="p-4 bg-white dark:bg-slate-800 border-t border-slate-200 dark:border-slate-700">
            <form id="chat-form" class="flex gap-2 relative">
                @csrf
                <input type="text" id="chat-input" class="w-full bg-slate-100 dark:bg-slate-700 text-slate-800 dark:text-white rounded-full px-4 py-2 text-sm focus:outline-none focus:ring-2 focus:ring-orange-500 pr-10" placeholder="Type a message..." required autocomplete="off">
                <button type="submit" class="absolute right-2 top-1/2 transform -translate-y-1/2 p-1.5 bg-orange-500 rounded-full text-white hover:bg-orange-600 transition-colors disabled:opacity-50 disabled:cursor-not-allowed">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 19l9 2-9-18-9 18 9-2zm0 0v-8" />
                    </svg>
                </button>
            </form>
        </div>
    </div>
</div>

<script>
document.addEventListener('DOMContentLoaded', function() {
    const chatToggle = document.getElementById('chat-toggle');
    const chatWindow = document.getElementById('chat-window');
    const chatClose = document.getElementById('chat-close');
    const chatForm = document.getElementById('chat-form');
    const chatInput = document.getElementById('chat-input');
    const messagesContainer = document.getElementById('chat-messages');

    // Toggle Chat
    function toggleChat() {
        if (chatWindow.classList.contains('hidden')) {
            chatWindow.classList.remove('hidden');
            setTimeout(() => {
                chatWindow.classList.remove('scale-95', 'opacity-0');
                chatInput.focus();
            }, 10);
        } else {
            chatWindow.classList.add('scale-95', 'opacity-0');
            setTimeout(() => {
                chatWindow.classList.add('hidden');
            }, 300);
        }
    }

    chatToggle.addEventListener('click', toggleChat);
    chatClose.addEventListener('click', toggleChat);

    // Add User Message
    function addUserMessage(text) {
        const div = document.createElement('div');
        div.className = 'flex items-start gap-2.5 justify-end';
        div.innerHTML = `
            <div class="flex flex-col w-full max-w-[320px] leading-1.5 p-4 border-gray-200 bg-orange-500 rounded-s-xl rounded-ee-xl shadow-sm text-white">
               <p class="text-sm font-normal">${text}</p>
            </div>
        `;
        messagesContainer.appendChild(div);
        messagesContainer.scrollTop = messagesContainer.scrollHeight;
    }

    // Add Bot Message
    function addBotMessage(text) {
        const div = document.createElement('div');
        div.className = 'flex items-start gap-2.5';
        div.innerHTML = `
            <div class="w-8 h-8 rounded-full bg-gradient-to-br from-orange-500 to-red-500 flex items-center justify-center text-white text-xs font-bold shrink-0">
                AI
            </div>
            <div class="flex flex-col w-full max-w-[320px] leading-1.5 p-4 border-gray-200 bg-white rounded-e-xl rounded-es-xl dark:bg-slate-800 dark:border-slate-700 shadow-sm">
               <p class="text-sm font-normal text-slate-800 dark:text-slate-200">${text}</p>
            </div>
        `;
        messagesContainer.appendChild(div);
        messagesContainer.scrollTop = messagesContainer.scrollHeight;
    }

    // Add Loading Indicator
    function addLoading() {
        const div = document.createElement('div');
        div.id = 'chat-loading';
        div.className = 'flex items-start gap-2.5';
        div.innerHTML = `
            <div class="w-8 h-8 rounded-full bg-gradient-to-br from-orange-500 to-red-500 flex items-center justify-center text-white text-xs font-bold shrink-0">
                AI
            </div>
            <div class="flex flex-col w-auto leading-1.5 p-4 border-gray-200 bg-white rounded-e-xl rounded-es-xl dark:bg-slate-800 dark:border-slate-700 shadow-sm">
               <div class="flex space-x-1">
                    <div class="w-2 h-2 bg-gray-400 rounded-full animate-bounce" style="animation-delay: 0s"></div>
                    <div class="w-2 h-2 bg-gray-400 rounded-full animate-bounce" style="animation-delay: 0.2s"></div>
                    <div class="w-2 h-2 bg-gray-400 rounded-full animate-bounce" style="animation-delay: 0.4s"></div>
               </div>
            </div>
        `;
        messagesContainer.appendChild(div);
        messagesContainer.scrollTop = messagesContainer.scrollHeight;
    }

    // Remove Loading Indicator
    function removeLoading() {
        const loading = document.getElementById('chat-loading');
        if (loading) loading.remove();
    }

    // Handle Submit
    chatForm.addEventListener('submit', async function(e) {
        e.preventDefault();
        const message = chatInput.value.trim();
        if (!message) return;

        // Clear input
        chatInput.value = '';
        
        // Add user message
        addUserMessage(message);

        // Show loading
        addLoading();

        try {
            const response = await fetch('{{ route("chat.send") }}', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                    'X-CSRF-TOKEN': '{{ csrf_token() }}'
                },
                body: JSON.stringify({ message: message })
            });

            if (!response.ok) {
                if (response.status === 419) {
                     throw new Error('Session expired. Please refresh the page.');
                }
                const errorData = await response.json();
                throw new Error(errorData.error || `Server Error: ${response.status}`);
            }

            const data = await response.json();
            
            removeLoading();

            if (data.error) {
                addBotMessage('Sorry, I encountered an error: ' + data.error);
                console.error(data.error);
            } else {
                addBotMessage(data.reply); 
            }

        } catch (error) {
            removeLoading();
            addBotMessage(error.message || 'Network error. Please check your connection.');
            console.error(error);
        }
    });
});
</script>
