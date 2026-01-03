<x-app-layout>
    @push('styles')
        <link rel="stylesheet" href="{{ asset('css/admin/profile._admin.css') }}">
    @endpush


    <main class="container my-5" x-data="{ tab: 'profile' }">
        <div class="d-flex justify-content-between align-items-center mb-4">
             <h1 class="fs-1 font-bold text-white">
                <i class="bi bi-person-circle"></i><span class="text-blue-700"> Profile</span>
            </h1>    
    
            @if (Auth::user()->role === 'admin')
                <a href="{{ route('books.index') }}" class="btn btn-secondary w-25">
                    Back to Books
                </a>
            @else
                <a href="{{ route('user.dashboard') }}" class="btn btn-secondary w-25">
                    Back to Dashboard
                </a>
            @endif
        </div>

        <div class="mb-4 border-bottom">
            <div class="d-flex gap-4">
                <button class="tab-btn" @click="tab='profile'" :class="{ 'active': tab==='profile' }">
                    Account Setting
                </button>
                <button class="tab-btn" @click="tab='password'" :class="{ 'active': tab==='password' }">
                    Login & Security
                </button>
                <button class="tab-btn" @click="tab='danger'" :class="{ 'active': tab==='danger' }">
                    Delete Account
                </button>
            </div>
        </div>

        <!-- Content -->
        <div class="row g-4">
            <div class="col-md-4 col-lg-3">
                <div class="card shadow-sm border-0 mb-4 pt-3">
                    <div class="card-body text-center">
                        <img
                            src="https://ui-avatars.com/api/?name={{ Auth::user()->name }}"
                            class="rounded-circle mb-3 d-block mx-auto"
                            width="90"
                            height="90"
                            alt="Profile">

                        <h6 class="mb-0">{{ Auth::user()->name }}</h6>
                        <small class="text-muted">{{ Auth::user()->email }}</small>
                    </div>
                </div>

                @if($totalFineRemaining > 0)
                    <div class="alert alert-danger text-center">
                        <strong>Total Fine</strong><br>
                        Rp {{ number_format($totalFineRemaining, 0, ',', '.') }}
                    </div>
                @endif

                @if (Auth::check() && Auth::user()->role === 'user')
                    <div class="alert alert-success text-center">
                        <p><strong>Books borrowed:</strong> {{ $borrowedCount }}</p>
                    </div>
                @endif

            </div>

            <div class="col-md-8 col-lg-9">

                <div class="card shadow-sm border-0 pt-3">
                    <div class="card-body">

                        <div x-show="tab==='profile'" x-transition>
                            <h5 class="mb-1">Profile Information</h5>
                            <p class="text-muted mb-4">
                                Update your account's profile information and email address.
                            </p>

                            @include('profile.partials.update-profile-information-form')
                        </div>


                        <!-- UPDATE PASSWORD -->
                        <div x-show="tab==='password'" x-transition>
                            <h5 class="mb-1">Update Password</h5>
                            <p class="text-muted mb-4">
                                Ensure your account is using a long, random password to stay secure.
                            </p>

                            @include('profile.partials.update-password-form')
                        </div>

                        <!-- DELETE ACCOUNT -->
                        <div x-show="tab==='danger'" x-transition>
                            <h5 class="mb-1 text-danger">Delete Account</h5>
                            <p class="text-muted mb-4">
                                Once your account is deleted, all data will be permanently removed.
                            </p>

                            @include('profile.partials.delete-user-form')
                        </div>

                    </div>
                </div>

            </div>

        </div>

    </main>
</x-app-layout>
