<x-app-layout>
    <x-slot name="header">
        <div class="flex items-center justify-between">
            <h2 class="font-bold text-2xl text-slate-800 leading-tight">
                {{ __('Account Settings') }}
            </h2>

            <div class="flex items-center space-x-2 text-sm text-slate-500 font-medium bg-slate-100 px-3 py-1 rounded-full">
                <span class="w-2 h-2 bg-blue-600 rounded-full animate-pulse"></span>
                <span>Role: {{ Auth::user()->role }}</span>
            </div>
            
            <div class="flex items-center space-x-2 text-sm text-slate-500 font-medium bg-slate-100 px-3 py-1 rounded-full">
                <span class="w-2 h-2 bg-blue-600 rounded-full animate-pulse"></span>
                    <span>Active Profile: {{ Auth::user()->name }}</span>
            </div>
        </div>
    </x-slot>

    <div class="py-12 bg-slate-50">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="grid grid-cols-1 lg:grid-cols-12 gap-8">
                
                <!-- Left Sidebar/Navigation (Optional for better design) -->
                <div class="lg:col-span-3">
                    <nav class="space-y-1">
                        <a href="#profile-info" class="flex items-center px-4 py-3 text-sm font-semibold rounded-lg bg-white text-blue-600 shadow-sm border border-slate-200">
                            <i class="fas fa-user-circle mr-3"></i> Profile Information
                        </a>
                        <a href="#update-password" class="flex items-center px-4 py-3 text-sm font-medium rounded-lg text-slate-600 hover:bg-slate-100 hover:text-slate-900 transition-colors">
                            <i class="fas fa-lock mr-3"></i> Security & Password
                        </a>
                        <a href="#delete-account" class="flex items-center px-4 py-3 text-sm font-medium rounded-lg text-red-600 hover:bg-red-50 transition-colors">
                            <i class="fas fa-trash-alt mr-3"></i> Danger Zone
                        </a>
                    </nav>

                </div>

                <!-- Main Content Area -->
                <div class="lg:col-span-9 space-y-8">
                    
                    <div id="profile-info" class="bg-white rounded-2xl shadow-sm border border-slate-200 overflow-hidden transition-all hover:shadow-md">
                        <div class="p-6 sm:p-8">
                            <div class="mb-6 flex items-center space-x-4">
                                <div class="w-12 h-12 bg-blue-100 rounded-xl flex items-center justify-center text-blue-600">
                                    <i class="fas fa-id-card text-xl"></i>
                                </div>
                                <div>
                                    <h3 class="text-lg font-bold text-slate-900">Profile Information</h3>
                                    <p class="text-sm text-slate-500">Update your account's public identity.</p>
                                </div>
                            </div>
                            <div class="max-w-2xl">
                                @include('profile.partials.update-profile-information-form')
                            </div>
                        </div>
                    </div>

                    <div id="update-password" class="bg-white rounded-2xl shadow-sm border border-slate-200 overflow-hidden transition-all hover:shadow-md">
                        <div class="p-6 sm:p-8">
                            <div class="mb-6 flex items-center space-x-4">
                                <div class="w-12 h-12 bg-amber-100 rounded-xl flex items-center justify-center text-amber-600">
                                    <i class="fas fa-shield-alt text-xl"></i>
                                </div>
                                <div>
                                    <h3 class="text-lg font-bold text-slate-900">Security</h3>
                                    <p class="text-sm text-slate-500">Ensure your account is using a secure password.</p>
                                </div>
                            </div>
                            <div class="max-w-2xl">
                                @include('profile.partials.update-password-form')
                            </div>
                        </div>
                    </div>

                    <div id="delete-account" class="bg-white rounded-2xl shadow-sm border border-red-100 overflow-hidden transition-all hover:shadow-md border-l-4 border-l-red-500">
                        <div class="p-6 sm:p-8">
                            <div class="mb-6 flex items-center space-x-4">
                                <div class="w-12 h-12 bg-red-100 rounded-xl flex items-center justify-center text-red-600">
                                    <i class="fas fa-exclamation-triangle text-xl"></i>
                                </div>
                                <div>
                                    <h3 class="text-lg font-bold text-slate-900">Delete Account</h3>
                                    <p class="text-sm text-slate-500 text-red-600 font-medium">This action is permanent and cannot be undone.</p>
                                </div>
                            </div>
                            <div class="max-w-2xl">
                                @include('profile.partials.delete-user-form')
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
