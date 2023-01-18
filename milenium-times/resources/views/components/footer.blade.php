<nav class="footer">
    <div class="container">
        <div class="logo-container">
            @if ($pages == 'sport')
                <img src="{{ asset('image\Milenium Logo - red.png') }}" alt="milenium-sport-logo">
                <span class="brand sport">Milenium <span>Sport</span></span>
            @elseif ($pages == 'env')
                <img src="{{ asset('image\milenium-logo-green.png') }}" alt="milenium-sport-logo">
                <span class="brand env">Milenium <span>Environment</span></span>
            @elseif ($pages == 'history')
                <img src="{{ asset('image\milenium-logo-gold.png') }}" alt="milenium-sport-logo">

                <span class="brand history">Milenium <span>History</span></span>
            @else
                <img src="{{ asset('image\milenium-logo-origin.png') }}" alt="milenium-sport-logo">
                <span class="brand base">Milenium <span>Times</span></span>
            @endif
        </div>
        <div class="description-container">
            <span class="title">Tentang Kami</span>
            <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Sunt deserunt eos dolorem blanditiis modi, ducimus nihil tenetur at repudiandae consequuntur fugit suscipit quod exercitationem distinctio quibusdam quia voluptatem assumenda sequi accusantium aperiam aspernatur perferendis soluta? Assumenda recusandae quisquam placeat ipsa.</p>
        </div>
        <div class="contact-container">
            <div class="follow-us">
                <div class="title">Ikuti Kami</div>
                <div class="logo-wrapper">
                    <a href="#"><x-icon.fb/></a>
                    <a href="#"><x-icon.ig/></a>
                </div>
            </div>
            <div class="contact">
                <div class="title">Hubungi Kami</div>
                <div class="contact-wrapper">
                    <div class="contact-item">
                        <x-icon.gmail/>
                        <span>mail@gmail.com</span>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="end-note">
        <div class="container">
            <p class="copyright">&#169; 2022 Milenium Group, All rights reserved</p>
            <div class="developer-contact">
                <span>developer</span>
                <div class="contact-wrapper">
                    <a href="https://www.instagram.com/vithiaz/" class="instagram">
                        <i class="fa-brands fa-instagram"></i>
                        <span>@vithiaz</span>
                    </a>
                </div>
            </div>
        </div>
    </div>
</nav>