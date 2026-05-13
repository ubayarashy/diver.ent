@extends('layouts.app')

@section('title', 'Contact - Diver Entertainment')

@section('content')
<div class="pt-32 pb-20 px-6">
    <div class="container mx-auto max-w-6xl">
        <!-- Header -->
        <div class="text-center mb-16 reveal">
            <span class="text-gray-500 uppercase text-xs tracking-wider">Get In Touch</span>
            <h1 class="text-4xl md:text-6xl font-bold mt-4 mb-6">Let's Start a <span class="animated-text">Conversation</span></h1>
            <p class="text-gray-400 text-lg max-w-2xl mx-auto">We'd love to hear about your project. Whether you're a brand looking for creative direction or a creator wanting to collaborate.</p>
        </div>

        <div class="grid grid-cols-1 lg:grid-cols-2 gap-12">
            <!-- Contact Form -->
            <div class="glass rounded-2xl p-8 reveal">
                <h2 class="text-2xl font-bold mb-6">Send us a message</h2>
                
                <form action="{{ route('contact.send') }}" method="POST" class="space-y-6">
                    @csrf
                    
                    <div class="grid grid-cols-2 gap-4">
                        <div>
                            <label class="block text-sm font-medium mb-2">Name</label>
                            <input type="text" name="name" required 
                                   class="w-full px-4 py-3 bg-white/5 border border-white/10 rounded-xl focus:outline-none focus:border-white/30 transition">
                        </div>
                        <div>
                            <label class="block text-sm font-medium mb-2">Email</label>
                            <input type="email" name="email" required 
                                   class="w-full px-4 py-3 bg-white/5 border border-white/10 rounded-xl focus:outline-none focus:border-white/30 transition">
                        </div>
                    </div>
                    
                    <div>
                        <label class="block text-sm font-medium mb-2">Subject</label>
                        <select name="subject" class="w-full px-4 py-3 bg-white/5 border border-white/10 rounded-xl focus:outline-none focus:border-white/30 transition">
                            <option value="creative">Creative Collaboration</option>
                            <option value="branding">Branding Project</option>
                            <option value="production">Production Inquiry</option>
                            <option value="other">Other</option>
                        </select>
                    </div>
                    
                    <div>
                        <label class="block text-sm font-medium mb-2">Message</label>
                        <textarea name="message" rows="5" required 
                                  class="w-full px-4 py-3 bg-white/5 border border-white/10 rounded-xl focus:outline-none focus:border-white/30 transition"></textarea>
                    </div>
                    
                    <button type="submit" class="w-full py-4 bg-white text-black rounded-xl font-semibold hover:bg-gray-200 transition magnetic-btn">
                        Send Message
                    </button>
                </form>
            </div>
            
            <!-- Contact Info -->
            <div class="space-y-8 reveal">
                <div class="glass rounded-2xl p-8">
                    <h2 class="text-2xl font-bold mb-6">Contact Info</h2>
                    
                    <div class="space-y-6">
                        <div class="flex items-start gap-4">
                            <div class="w-12 h-12 rounded-full bg-white/10 flex items-center justify-center">
                                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"></path>
                                </svg>
                            </div>
                            <div>
                                <h3 class="font-semibold mb-1">Email</h3>
                                <p class="text-gray-400">hello@diver.ent</p>
                                <p class="text-gray-400">creative@diver.ent</p>
                            </div>
                        </div>
                        
                        <div class="flex items-start gap-4">
                            <div class="w-12 h-12 rounded-full bg-white/10 flex items-center justify-center">
                                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 5a2 2 0 012-2h3.28a1 1 0 01.948.684l1.498 4.493a1 1 0 01-.502 1.21l-2.257 1.13a11.042 11.042 0 005.516 5.516l1.13-2.257a1 1 0 011.21-.502l4.493 1.498a1 1 0 01.684.949V19a2 2 0 01-2 2h-1C9.716 21 3 14.284 3 6V5z"></path>
                                </svg>
                            </div>
                            <div>
                                <h3 class="font-semibold mb-1">Phone / WhatsApp</h3>
                                <p class="text-gray-400">+62 812 3456 7890</p>
                                <p class="text-gray-400">+62 878 1234 5678</p>
                            </div>
                        </div>
                        
                        <div class="flex items-start gap-4">
                            <div class="w-12 h-12 rounded-full bg-white/10 flex items-center justify-center">
                                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"></path>
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"></path>
                                </svg>
                            </div>
                            <div>
                                <h3 class="font-semibold mb-1">Address</h3>
                                <p class="text-gray-400">Jl. Sei Deli No. 123</p>
                                <p class="text-gray-400">Medan, Sumatera Utara 20222</p>
                                <p class="text-gray-400">Indonesia</p>
                            </div>
                        </div>
                    </div>
                </div>
                
                <!-- Social Media Links -->
                <div class="glass rounded-2xl p-8">
                    <h2 class="text-xl font-bold mb-4">Follow Us</h2>
                    <div class="flex gap-4">
                        <a href="#" class="w-10 h-10 rounded-full bg-white/10 flex items-center justify-center hover:bg-white hover:text-black transition">IG</a>
                        <a href="#" class="w-10 h-10 rounded-full bg-white/10 flex items-center justify-center hover:bg-white hover:text-black transition">FB</a>
                        <a href="#" class="w-10 h-10 rounded-full bg-white/10 flex items-center justify-center hover:bg-white hover:text-black transition">TW</a>
                        <a href="#" class="w-10 h-10 rounded-full bg-white/10 flex items-center justify-center hover:bg-white hover:text-black transition">LK</a>
                        <a href="#" class="w-10 h-10 rounded-full bg-white/10 flex items-center justify-center hover:bg-white hover:text-black transition">YT</a>
                    </div>
                </div>
                
                <!-- WhatsApp Button -->
                <a href="https://wa.me/6281234567890" target="_blank" 
                   class="glass rounded-2xl p-8 flex items-center justify-between group hover:border-white/30 transition">
                    <div>
                        <h3 class="font-bold">Chat on WhatsApp</h3>
                        <p class="text-gray-400 text-sm">Fast response within 24 hours</p>
                    </div>
                    <svg class="w-6 h-6 group-hover:translate-x-1 transition" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 8l4 4m0 0l-4 4m4-4H3"></path>
                    </svg>
                </a>
            </div>
        </div>
        
        <!-- Map -->
        <div class="mt-16 reveal">
            <div class="glass rounded-2xl overflow-hidden h-64">
                <iframe 
                    src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d127634.40280911762!2d98.6157929743164!3d3.5852421!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x30312fea3dd1e8d9%3A0xd2b9c52c4c13fa22!2sMedan%2C%20Medan%20City%2C%20North%20Sumatra!5e0!3m2!1sen!2sid!4v1699999999999!5m2!1sen!2sid" 
                    width="100%" height="100%" style="border:0;" allowfullscreen="" loading="lazy">
                </iframe>
            </div>
        </div>
    </div>
</div>
@endsection