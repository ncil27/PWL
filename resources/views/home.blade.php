<x-guest-layout>
    <div class="card card-info card-annoucement card-round">
        <div class="card-body text-center">
            <div class="card-opening">
                <span class="h1 fw-bold mb-3 items-center  text-white ">Website Pengajuan Dokumen | Teknik Informatika <br><br><br><br><br></span>
                {{-- <p class="mt-2 text-lg text-gray-300">Website Pengajuan Dokumen | Teknik Informatika</p> --}}
            </div>
        
            <div class="flex justify-center card-body">
                <!-- <a href="{{ route('register') }}">
                    <x-secondary-button class="ms-3">
                        {{ __('Register') }}
                    </x-secondary-button>
                </a> -->
                <a href="{{ route('login') }}">
                    <x-primary-button class="ms-3">
                        {{ __('Log in') }}
                    </x-primary-button>
                </a>
            </div>

        </div>
    </div>
    
</x-guest-layout>