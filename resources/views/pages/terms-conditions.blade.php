@extends('layouts.app')
@section('title', 'Terms and Conditions | Amber Tradings')

@section('content')
<!-- Hero Section -->
<section class="relative pt-32 pb-20 overflow-hidden">
    <div class="absolute inset-0">
        <img src="{{ asset('images/hero-about.webp') }}" alt="" class="w-full h-full object-cover">
        <div class="absolute inset-0 bg-gradient-to-br from-slate-900/95 via-slate-900/90 to-slate-800/95"></div>
    </div>
    <div class="container mx-auto px-4 relative z-10">
        <div class="max-w-4xl mx-auto text-center">
            <h1 class="text-4xl md:text-5xl font-bold text-white mb-6">Terms and Conditions</h1>
            <p class="text-xl text-white/70">Last updated: February 2026</p>
        </div>
    </div>
</section>

<!-- Terms Content -->
<section class="py-20 bg-white">
    <div class="container mx-auto px-4">
        <div class="max-w-4xl mx-auto">
            <div class="prose prose-lg max-w-none">
                
                <!-- Introduction -->
                <div class="mb-12">
                    <h2 class="text-2xl font-bold text-slate-900 mb-4">1. Introduction</h2>
                    <p class="text-slate-600 mb-4">
                        Welcome to Amber Tradings. These Terms and Conditions govern your use of our website and services. 
                        By accessing or using our platform, you agree to be bound by these terms. If you disagree with any 
                        part of these terms, you may not access our services.
                    </p>
                    <p class="text-slate-600">
                        Amber Tradings provides investment and trading services in various financial markets including 
                        forex, cryptocurrencies, stocks, indices, and commodities. Our services are intended for users 
                        who are at least 18 years of age and are legally permitted to engage in trading activities in 
                        their jurisdiction.
                    </p>
                </div>

                <!-- Account Registration -->
                <div class="mb-12">
                    <h2 class="text-2xl font-bold text-slate-900 mb-4">2. Account Registration</h2>
                    <p class="text-slate-600 mb-4">
                        To use our services, you must create an account by providing accurate and complete information. 
                        You are responsible for:
                    </p>
                    <ul class="list-disc pl-6 text-slate-600 space-y-2">
                        <li>Maintaining the confidentiality of your account credentials</li>
                        <li>All activities that occur under your account</li>
                        <li>Notifying us immediately of any unauthorized access</li>
                        <li>Providing accurate and up-to-date information</li>
                        <li>Ensuring you meet the minimum age requirement of 18 years</li>
                    </ul>
                </div>

                <!-- Investment Services -->
                <div class="mb-12">
                    <h2 class="text-2xl font-bold text-slate-900 mb-4">3. Investment Services</h2>
                    <p class="text-slate-600 mb-4">
                        Amber Tradings offers various investment packages and trading services. By using our investment 
                        services, you acknowledge and agree that:
                    </p>
                    <ul class="list-disc pl-6 text-slate-600 space-y-2">
                        <li>All investments carry inherent risks, including the potential loss of capital</li>
                        <li>Past performance does not guarantee future results</li>
                        <li>Returns on investment are not guaranteed</li>
                        <li>Investment decisions are made at your own risk</li>
                        <li>You should only invest funds you can afford to lose</li>
                    </ul>
                </div>

                <!-- Deposits and Withdrawals -->
                <div class="mb-12">
                    <h2 class="text-2xl font-bold text-slate-900 mb-4">4. Deposits and Withdrawals</h2>
                    <p class="text-slate-600 mb-4">
                        Our deposit and withdrawal policies are as follows:
                    </p>
                    <ul class="list-disc pl-6 text-slate-600 space-y-2">
                        <li>Deposits are processed within 24 hours of confirmation</li>
                        <li>Minimum deposit amounts vary by investment package</li>
                        <li>Withdrawals are processed within 1-5 business days</li>
                        <li>We reserve the right to request identity verification before processing withdrawals</li>
                        <li>Any applicable fees will be clearly disclosed before transactions</li>
                    </ul>
                </div>

                <!-- User Conduct -->
                <div class="mb-12">
                    <h2 class="text-2xl font-bold text-slate-900 mb-4">5. User Conduct</h2>
                    <p class="text-slate-600 mb-4">
                        Users agree not to engage in any of the following prohibited activities:
                    </p>
                    <ul class="list-disc pl-6 text-slate-600 space-y-2">
                        <li>Fraudulent activities or misrepresentation</li>
                        <li>Money laundering or terrorist financing</li>
                        <li>Unauthorized access to our systems</li>
                        <li>Interfering with other users' access to services</li>
                        <li>Violating any applicable laws or regulations</li>
                        <li>Creating multiple accounts to circumvent restrictions</li>
                    </ul>
                </div>

                <!-- Risk Disclosure -->
                <div class="mb-12">
                    <h2 class="text-2xl font-bold text-slate-900 mb-4">6. Risk Disclosure</h2>
                    <div class="bg-orange-50 border-l-4 border-orange-500 p-6 rounded-r-lg">
                        <p class="text-slate-700 font-medium mb-4">
                            <strong>Important Risk Warning:</strong>
                        </p>
                        <p class="text-slate-600 mb-4">
                            Trading in financial markets involves substantial risk of loss and is not suitable for all 
                            investors. The high degree of leverage can work against you as well as for you. Before 
                            deciding to trade, you should carefully consider your investment objectives, level of 
                            experience, and risk appetite.
                        </p>
                        <p class="text-slate-600">
                            You should be aware of all the risks associated with trading and seek advice from an 
                            independent financial advisor if you have any doubts.
                        </p>
                    </div>
                </div>

                <!-- Intellectual Property -->
                <div class="mb-12">
                    <h2 class="text-2xl font-bold text-slate-900 mb-4">7. Intellectual Property</h2>
                    <p class="text-slate-600">
                        All content on this website, including but not limited to text, graphics, logos, images, and 
                        software, is the property of Amber Tradings and is protected by international copyright laws. 
                        Unauthorized use of any materials may violate copyright, trademark, and other laws.
                    </p>
                </div>

                <!-- Limitation of Liability -->
                <div class="mb-12">
                    <h2 class="text-2xl font-bold text-slate-900 mb-4">8. Limitation of Liability</h2>
                    <p class="text-slate-600 mb-4">
                        To the maximum extent permitted by law:
                    </p>
                    <ul class="list-disc pl-6 text-slate-600 space-y-2">
                        <li>Amber Tradings shall not be liable for any indirect, incidental, or consequential damages</li>
                        <li>We do not guarantee uninterrupted access to our services</li>
                        <li>We are not responsible for losses due to market conditions</li>
                        <li>Our liability is limited to the amount of fees paid by the user</li>
                    </ul>
                </div>

                <!-- Privacy Policy -->
                <div class="mb-12">
                    <h2 class="text-2xl font-bold text-slate-900 mb-4">9. Privacy Policy</h2>
                    <p class="text-slate-600">
                        Your privacy is important to us. We collect and process personal data in accordance with our 
                        Privacy Policy. By using our services, you consent to the collection and use of your information 
                        as described in our Privacy Policy. We implement industry-standard security measures to protect 
                        your data.
                    </p>
                </div>

                <!-- Modifications -->
                <div class="mb-12">
                    <h2 class="text-2xl font-bold text-slate-900 mb-4">10. Modifications to Terms</h2>
                    <p class="text-slate-600">
                        We reserve the right to modify these Terms and Conditions at any time. Changes will be effective 
                        immediately upon posting on our website. Your continued use of our services after any changes 
                        constitutes acceptance of the new terms. We encourage you to review these terms periodically.
                    </p>
                </div>

                <!-- Termination -->
                <div class="mb-12">
                    <h2 class="text-2xl font-bold text-slate-900 mb-4">11. Termination</h2>
                    <p class="text-slate-600">
                        We may terminate or suspend your account and access to our services at our sole discretion, 
                        without prior notice, for conduct that we believe violates these Terms or is harmful to other 
                        users, us, or third parties, or for any other reason.
                    </p>
                </div>

                <!-- Governing Law -->
                <div class="mb-12">
                    <h2 class="text-2xl font-bold text-slate-900 mb-4">12. Governing Law</h2>
                    <p class="text-slate-600">
                        These Terms shall be governed by and construed in accordance with applicable laws. Any disputes 
                        arising from these terms or your use of our services shall be resolved through binding arbitration 
                        or in a court of competent jurisdiction.
                    </p>
                </div>

                <!-- Contact Information -->
                <div class="bg-slate-100 p-8 rounded-2xl">
                    <h2 class="text-2xl font-bold text-slate-900 mb-4">13. Contact Us</h2>
                    <p class="text-slate-600 mb-4">
                        If you have any questions about these Terms and Conditions, please contact us:
                    </p>
                    <ul class="text-slate-600 space-y-2">
                        <li><strong>Email:</strong> support@ambertradings.org</li>
                        <li><strong>Website:</strong> <a href="{{ route('contact') }}" class="text-orange-500 hover:underline">Contact Page</a></li>
                    </ul>
                </div>

            </div>
        </div>
    </div>
</section>
@endsection
