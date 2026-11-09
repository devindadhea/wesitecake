@extends('layouts.app')

@section('content')

@php
    // Nomor WA global agar bisa dipakai di section mana pun (termasuk modal)
    $contactGlobal = \App\Models\Contact::first();
    $waNumberGlobal = preg_replace('/[^0-9]/', '', $contactGlobal->whatsapp_number ?? '6281234567890');
    if (str_starts_with($waNumberGlobal, '0')) {
        $waNumberGlobal = '62' . substr($waNumberGlobal, 1);
    }
@endphp

<!-- HERO SECTION 1 -->
<section id="beranda" class="relative pt-32 pb-24 max-w-7xl mx-auto px-4 md:px-6 grid md:grid-cols-2 gap-12 md:gap-16 items-center">
    <div class="text-center md:text-left">
        <span class="inline-block text-[11px] md:text-xs font-semibold tracking-[0.25em] text-[#C2185B]/70 uppercase mb-4">Toko Roti Modern</span>
        <h2 class="text-4xl md:text-6xl font-extrabold text-[#C2185B] leading-[1.1] tracking-tight">
            {{ $hero->title ?? 'Toko Roti Terbaik' }}<br />
            <span class="bg-gradient-to-r from-[#F8BBD9] to-[#C2185B] bg-clip-text text-transparent">
                {{ $hero->subtitle ?? 'Segar & Lezat' }}
            </span>
        </h2>
        <p class="mt-6 text-base md:text-lg text-gray-600 leading-relaxed max-w-xl mx-auto md:mx-0">
            {{ $hero->description ?? 'Nikmati berbagai macam roti dan kue segar buatan tangan. Pesan online dengan mudah dan cepat.' }}
        </p>
        <a href="{{ $hero->button_link ?? '#terlaris' }}" 
           class="inline-flex items-center gap-2 mt-8 px-7 py-3.5 bg-[#C2185B] text-white font-semibold hover:bg-[#a0154a] transition-colors duration-300 shadow-lg">
            {{ $hero->button_text ?? 'Lihat Produk' }}
            <i class="bi bi-arrow-right"></i>
        </a>
    </div>
    <div class="relative flex justify-center mt-6">
        <div class="absolute inset-0 flex justify-center items-center">
            <div class="w-[320px] md:w-[440px] h-[320px] md:h-[440px] rounded-full blur-3xl opacity-60 bg-[radial-gradient(circle_at_center,_#F8BBD9,_#C2185B)]"></div>
        </div>
        <img src="{{ $hero->strawberry_left_url ?? asset('images/s1.png') }}" class="absolute left-[10px] top-[40%] w-[85px] md:w-[110px] animate-3dfloat" alt="Strawberry">
        <img src="{{ $hero->strawberry_right_url ?? asset('images/s2.png') }}" class="absolute right-[10px] top-[55%] w-[100px] md:w-[110px] animate-3dfloat2" alt="Strawberry">
        <img src="{{ $hero->cake_image_url ?? asset('images/cake1.png') }}" alt="Cake" class="w-[260px] md:w-[330px] animate-half-rotate-3d z-[10]">
    </div>
</section>

<!-- CATEGORIES SECTION -->
<section id="kategori" class="py-16 bg-white">
    <div class="max-w-7xl mx-auto text-center px-4 md:px-6">
        <span class="inline-block text-[11px] md:text-xs font-semibold tracking-[0.25em] text-[#C2185B]/70 uppercase mb-3">Pilih Kategori</span>
        <h3 class="text-3xl md:text-4xl font-extrabold text-[#C2185B] tracking-tight">Kategori Produk</h3>

        <div class="flex flex-wrap justify-center gap-3 md:gap-5 mt-10">
            @forelse($categories as $category)
            <div class="flex flex-col items-center cursor-pointer group w-[90px] md:w-[110px]" onclick="filterProducts('{{ $category->name }}')">
                <div class="overflow-hidden">
                   <img src="{{ $category->image_url ?? asset('images/' . $category->image) }}" 
             class="w-16 h-16 md:w-20 md:h-20 rounded-full object-cover shadow-md hover:scale-105 transition-all duration-300 category-img border-2 border-transparent" 
             data-category="{{ $category->name }}"
             alt="{{ $category->name }}">
                </div>
                <p class="font-semibold text-sm md:text-base mt-2 text-gray-700 category-name text-center group-hover:text-[#C2185B] transition-colors duration-300">{{ $category->name }}</p>
            </div>
            @empty
                <p class="text-gray-500">No categories found</p>
            @endforelse
        </div>

        <div class="flex justify-center mt-10">
            <button onclick="filterProducts('all')" 
                    id="resetFilterBtn"
                    class="px-6 py-2.5 bg-[#C2185B] hover:bg-[#a0154a] text-white font-semibold transition-colors duration-300 shadow-md">
                Tampilkan Semua Produk
            </button>
        </div>
    </div>
</section>

<!-- PRODUCTS SECTION -->
<section id="terlaris" class="relative py-20 max-w-7xl mx-auto px-4 md:px-6">
    <div class="text-center mb-12">
        <span class="inline-block text-[11px] md:text-xs font-semibold tracking-[0.25em] text-[#C2185B]/70 uppercase mb-3">Menu Kami</span>
        <h3 class="text-3xl md:text-4xl font-extrabold text-[#C2185B] tracking-tight">Produk</h3>
    </div>
    <div class="grid grid-cols-3 md:grid-cols-5 gap-4 md:gap-8" id="productsContainer">
        @forelse($allProducts as $product)
        <div class="product-card group transition-all duration-300 hover:-translate-y-1 cursor-pointer" 
             data-category="{{ $product->category }}"
             data-name="{{ $product->name }}"
             data-description="{{ $product->description }}"
             data-price="{{ number_format($product->price, 0, ',', '.') }}"
             data-rating="{{ $product->rating }}"
             data-image="{{ $product->image_url ?? asset('images/' . $product->image) }}"
             onclick="openProductModal(this)">
            <div class="overflow-hidden mb-2 md:mb-3">
                <img src="{{ $product->image_url ?? asset('images/' . $product->image) }}" 
                     class="w-full h-28 md:h-48 object-cover group-hover:scale-105 transition-transform duration-500" 
                     alt="{{ $product->name }}">
            </div>
            <h4 class="text-xs md:text-lg font-semibold text-[#C2185B] line-clamp-1 tracking-tight">{{ Str::limit($product->name, 15) }}</h4>
            <p class="text-gray-600 text-[10px] md:text-sm mt-0.5 md:mt-1 leading-relaxed hidden md:line-clamp-2">{{ Str::limit($product->description, 40) }}</p>
            <div class="flex items-center mt-1 md:mt-2">
                <span class="text-yellow-500 text-[8px] md:text-base tracking-tight">
                    @for($i = 1; $i <= 5; $i++)
                        @if($i <= floor($product->rating))
                            ★
                        @elseif($i - $product->rating < 1 && $i - $product->rating > 0)
                            ½
                        @else
                            ☆
                        @endif
                    @endfor
                </span>
                <span class="text-[8px] md:text-xs text-gray-500 ml-1 md:ml-2">({{ $product->rating }})</span>
            </div>
            <p class="text-[10px] md:text-base font-bold text-[#C2185B] mt-1 md:mt-2 tracking-wide">Rp {{ number_format($product->price, 0, ',', '.') }}</p>
        </div>
        @empty
            <p class="col-span-3 md:col-span-5 text-center text-gray-500">No products found</p>
        @endforelse
    </div>

    <!-- MODAL DETAIL PRODUK -->
    <div id="productModal" class="fixed inset-0 z-[100] hidden items-center justify-center p-4 bg-black/60 backdrop-blur-sm">
        <div class="bg-white max-w-3xl w-full max-h-[90vh] overflow-y-auto shadow-2xl relative" onclick="event.stopPropagation()">
            <button onclick="closeProductModal()" 
                    class="absolute top-3 right-3 z-10 w-10 h-10 flex items-center justify-center bg-white/90 backdrop-blur text-[#C2185B] hover:bg-[#C2185B] hover:text-white transition-colors duration-300 shadow-md">
                <i class="bi bi-x-lg text-lg"></i>
            </button>
            <div class="grid md:grid-cols-2">
                <div class="bg-gray-100 aspect-square md:aspect-auto md:min-h-[400px]">
                    <img id="modalImage" src="" alt="" class="w-full h-full object-cover">
                </div>
                <div class="p-6 md:p-8 flex flex-col">
                    <span class="inline-block text-[11px] font-semibold tracking-[0.25em] text-[#C2185B]/70 uppercase mb-2">Detail Produk</span>
                    <h3 id="modalName" class="text-2xl md:text-3xl font-extrabold text-[#C2185B] tracking-tight leading-tight"></h3>
                    <div class="flex items-center mt-3">
                        <span id="modalRating" class="text-yellow-500 text-base tracking-tight"></span>
                        <span id="modalRatingValue" class="text-sm text-gray-500 ml-2"></span>
                    </div>
                    <p id="modalDescription" class="mt-5 text-gray-600 leading-relaxed text-base"></p>
                    <div class="mt-auto pt-6">
                        <p class="text-xs uppercase tracking-wider text-gray-500 font-semibold mb-1">Harga</p>
                        <p id="modalPrice" class="text-2xl md:text-3xl font-extrabold text-[#C2185B] tracking-tight"></p>
                    </div>
                    <a id="modalWhatsapp" href="#" target="_blank"
                       class="mt-5 inline-flex items-center justify-center gap-2 w-full bg-[#C2185B] hover:bg-[#a0154a] text-white font-semibold py-3 px-4 transition-colors duration-300">
                        <i class="bi bi-whatsapp text-lg"></i>
                        Pesan via WhatsApp
                    </a>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- ABOUT SECTION -->
<section id="tentang" class="relative py-24 max-w-7xl mx-auto px-4 md:px-6">

    @php
        $iconMap = [
            'bahan'      => 'bi-basket2',
            'segar'      => 'bi-flower1',
            'fresh'      => 'bi-flower1',
            'handmade'   => 'bi-hand-thumbs-up',
            'tangan'     => 'bi-hand-thumbs-up',
            'buatan'     => 'bi-hand-thumbs-up',
            'kualitas'   => 'bi-patch-check',
            'quality'    => 'bi-patch-check',
            'halal'      => 'bi-check2-circle',
            'higienis'   => 'bi-shield-check',
            'sehat'      => 'bi-heart-pulse',
            'cepat'      => 'bi-lightning-charge',
            'antar'      => 'bi-truck',
            'kirim'      => 'bi-truck',
            'harga'      => 'bi-tag',
            'murah'      => 'bi-tag',
            'varian'     => 'bi-grid-3x3-gap',
            'lengkap'    => 'bi-grid-3x3-gap',
            'rasa'       => 'bi-emoji-smile',
            'enak'       => 'bi-emoji-smile',
            'cinta'      => 'bi-heart',
            'love'       => 'bi-heart',
            'lokasi'     => 'bi-geo-alt',
            'toko'       => 'bi-shop',
        ];

        $resolveIcon = function ($title) use ($iconMap) {
            $t = strtolower($title ?? '');
            foreach ($iconMap as $keyword => $icon) {
                if (str_contains($t, $keyword)) {
                    return 'bi ' . $icon;
                }
            }
            return 'bi bi-star';
        };
    @endphp

    <!-- Desktop Layout -->
    <div class="hidden md:grid md:grid-cols-2 items-center gap-6 lg:gap-8">
        <div class="relative order-1 flex justify-start">
            <img src="{{ $about->image_url ?? asset('images/c8.png') }}" 
                 class="w-56 md:w-72 lg:w-[420px] aspect-square object-cover shadow-xl" 
                 alt="Tentang Toko">
        </div>
        <div class="order-2">
            <span class="inline-block text-[11px] md:text-xs font-semibold tracking-[0.25em] text-[#C2185B]/70 uppercase mb-3">Tentang Kami</span>
            <h3 class="text-3xl md:text-4xl font-extrabold text-[#C2185B] leading-[1.15] tracking-tight">{{ $about->title ?? 'Tentang Pit Bolu' }}</h3>
            <p class="mt-5 text-gray-600 leading-relaxed text-base md:text-lg font-normal">{{ $about->description ?? 'Herlina Cookies & Cakes adalah toko roti modern yang menyediakan produk segar buatan tangan. Kami fokus pada kualitas bahan dan rasa yang autentik.' }}</p>
            <ul class="mt-8 space-y-4 text-gray-700 text-base md:text-lg">
                @forelse($features as $feature)
                <li class="flex items-center gap-4 group">
                    <span class="w-10 h-10 flex items-center justify-center bg-[#C2185B] text-pink-50 shadow-md group-hover:scale-110 transition-transform duration-300">
                        <i class="{{ $resolveIcon($feature->title) }} text-lg leading-none"></i>
                    </span>
                    <span class="font-semibold tracking-tight">{{ $feature->title }}</span>
                </li>
                @empty
                    <li>No features found</li>
                @endforelse
            </ul>
        </div>
    </div>

    <!-- Mobile Layout -->
    <div class="block md:hidden">
        <span class="block text-center text-[11px] font-semibold tracking-[0.25em] text-[#C2185B]/70 uppercase mb-2">Tentang Kami</span>
        <h3 class="text-3xl font-extrabold text-[#C2185B] leading-[1.15] tracking-tight text-center mb-6">{{ $about->title ?? 'Tentang Pit Bolu' }}</h3>
        <p class="text-gray-600 leading-relaxed text-base font-normal mb-6">{{ $about->description ?? 'Pita Bolu adalah toko roti modern yang menyediakan produk segar buatan tangan. Kami fokus pada kualitas bahan dan rasa yang autentik.' }}</p>
        <div class="relative order-1">
            <img src="{{ $about->image_url ?? asset('images/c8.png') }}" 
                 class="w-full max-w-[420px] aspect-square object-cover shadow-xl" 
                 alt="Tentang Toko">
        </div>
        <ul class="mt-6 space-y-4 text-gray-700 text-base">
            @forelse($features as $feature)
            <li class="flex items-center gap-4">
                <span class="w-10 h-10 flex items-center justify-center bg-[#C2185B] text-pink-50 shadow-md">
                    <i class="{{ $resolveIcon($feature->title) }} text-lg leading-none"></i>
                </span>
                <span class="font-semibold tracking-tight">{{ $feature->title }}</span>
            </li>
            @empty
                <li>No features found</li>
            @endforelse
        </ul>
    </div>
</section>

<!-- KONTAK & LOKASI SECTION -->
<section id="kontak" class="relative py-20 max-w-7xl mx-auto px-4 md:px-6">

  @php
      $contact = \App\Models\Contact::first();
      $businessHours = \App\Models\BusinessHour::orderBy('order')->get();
  @endphp

  <div class="text-center mb-12">
      <span class="inline-block text-[11px] md:text-xs font-semibold tracking-[0.25em] text-[#C2185B]/70 uppercase mb-3">Hubungi Kami</span>
      <h3 class="text-3xl md:text-4xl font-extrabold text-[#C2185B] tracking-tight">Kontak & Lokasi</h3>
  </div>

  <div class="grid md:grid-cols-2 gap-8 md:gap-12">

    <div class="space-y-8">

      <!-- Jam Operasi -->
      <div class="bg-white p-6 md:p-8 shadow-sm hover:shadow-lg transition-shadow duration-300 border border-pink-200/40">
        <h4 class="text-xl font-bold text-[#C2185B] mb-5 flex items-center gap-3 tracking-tight">
          <span class="w-10 h-10 flex items-center justify-center bg-[#C2185B] text-pink-50 shadow-md">
            <i class="bi bi-clock text-lg leading-none"></i>
          </span>
          Jam Operasi
        </h4>
        <div class="space-y-3">
          @forelse($businessHours as $hour)
          <div class="flex justify-between items-center py-2.5 border-b border-gray-100 last:border-0">
            <span class="text-gray-600 font-medium">{{ $hour->day }}</span>
            <span class="font-bold text-[#C2185B] tracking-wide">{{ $hour->open_time }} - {{ $hour->close_time }}</span>
          </div>
          @empty
          <div class="flex justify-between items-center py-2.5 border-b border-gray-100">
            <span class="text-gray-600 font-medium">Senin - Jumat</span>
            <span class="font-bold text-[#C2185B] tracking-wide">08:00 - 20:00</span>
          </div>
          <div class="flex justify-between items-center py-2.5 border-b border-gray-100">
            <span class="text-gray-600 font-medium">Sabtu - Minggu</span>
            <span class="font-bold text-[#C2185B] tracking-wide">08:00 - 22:00</span>
          </div>
          @endforelse
          <p class="text-sm text-gray-500 mt-4 flex items-start gap-2 leading-relaxed">
            <i class="bi bi-info-circle text-[#C2185B] mt-0.5"></i>
            <span>Kami buka setiap hari termasuk hari libur</span>
          </p>
        </div>
      </div>

      <!-- WhatsApp -->
      <div class="bg-white p-6 md:p-8 shadow-sm hover:shadow-lg transition-shadow duration-300 border border-pink-200/40">
        <h4 class="text-xl font-bold text-[#C2185B] mb-5 flex items-center gap-3 tracking-tight">
          <span class="w-10 h-10 flex items-center justify-center bg-[#C2185B] text-pink-50 shadow-md">
            <i class="bi bi-whatsapp text-lg leading-none"></i>
          </span>
          Pesan via WhatsApp
        </h4>
        <p class="text-gray-600 mb-5 leading-relaxed">
          Langsung chat kami untuk pemesanan atau konsultasi produk
        </p>
        <div class="mb-6">
          <div class="flex items-center gap-4">
            <div class="w-11 h-11 bg-pink-100 flex items-center justify-center">
              <i class="bi bi-phone text-pink-600 text-lg"></i>
            </div>
            <div>
              <p class="text-xs uppercase tracking-wider text-gray-500 font-semibold">Nomor WhatsApp</p>
              <p class="font-bold text-gray-800 tracking-tight">{{ $contact->whatsapp_number ?? '+62 812 3456 7890' }}</p>
            </div>
          </div>
        </div>
        @php
            $waNumber = preg_replace('/[^0-9]/', '', $contact->whatsapp_number ?? '6281234567890');
            if (str_starts_with($waNumber, '0')) {
                $waNumber = '62' . substr($waNumber, 1);
            }
            $rawMessage = $contact->whatsapp_message ?? 'Halo, saya mau tanya tentang produk dan pesanan';
            $waMessage = urlencode($rawMessage);
        @endphp
        <a 
          href="https://wa.me/{{ $waNumber }}?text={{ $waMessage }}"
          target="_blank"
          class="inline-flex items-center gap-2 w-full justify-center bg-[#C2185B] hover:bg-[#a0154a] text-white font-semibold py-3 px-4 transition-colors duration-300"
        >
          <i class="bi bi-whatsapp text-lg"></i>
          Pesan Sekarang
        </a>
      </div>

    </div>

    <!-- Lokasi -->
    <div class="bg-white p-6 md:p-8 shadow-sm hover:shadow-lg transition-shadow duration-300 border border-pink-200/40 flex flex-col">
      <h4 class="text-xl font-bold text-[#C2185B] mb-5 flex items-center gap-3 tracking-tight">
        <span class="w-10 h-10 flex items-center justify-center bg-[#C2185B] text-pink-50 shadow-md">
          <i class="bi bi-geo-alt text-lg leading-none"></i>
        </span>
        Lokasi Toko
      </h4>

      <p class="text-gray-600 mb-2 leading-relaxed">
        Kunjungi toko kami di alamat berikut:
      </p>
      <p class="font-semibold text-gray-800 mb-4 leading-relaxed">
        {{ $contact->address ?? 'Jl. Raya Bandung No. 123, Bandung, Jawa Barat' }}
      </p>

      <div class="relative group overflow-hidden border border-gray-200 shadow-sm flex-1 min-h-[320px]">
        <div class="absolute inset-0 bg-gray-100">
          @if(!empty($contact->maps_embed))
            <iframe 
              src="{{ $contact->maps_embed }}"
              width="100%" 
              height="100%" 
              style="border:0;" 
              allowfullscreen="" 
              loading="lazy"
              class="w-full h-full grayscale-[20%] group-hover:grayscale-0 transition-all duration-500"
            ></iframe>
          @else
            <iframe 
              src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3960.731997569548!2d107.6181271!3d-6.917586!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x2e68e62c3e3b44d1%3A0x654b78d6d0d0b2b9!2sBandung!5e0!3m2!1sen!2sid!4v1632987654321!5m2!1sen!2sid"
              width="100%" 
              height="100%" 
              style="border:0;" 
              allowfullscreen="" 
              loading="lazy"
              class="w-full h-full grayscale-[20%] group-hover:grayscale-0 transition-all duration-500"
            ></iframe>
          @endif
        </div>

        @if(!empty($contact->maps_embed))
        <a href="{{ $contact->maps_embed }}" 
           target="_blank"
           class="absolute bottom-3 right-3 inline-flex items-center gap-2 bg-white/90 backdrop-blur px-4 py-2 text-xs md:text-sm font-semibold text-[#C2185B] shadow-md hover:bg-[#C2185B] hover:text-white transition-colors duration-300">
          <i class="bi bi-box-arrow-up-right"></i>
          Buka di Google Maps
        </a>
        @endif
      </div>

      <div class="mt-5 flex flex-wrap gap-6">
        <div class="flex items-center gap-2">
          <i class="bi bi-truck text-[#C2185B] text-lg"></i>
          <span class="text-sm text-gray-600 font-medium">{{ $contact->delivery_info ?? 'Gratis ongkir area Bandung' }}</span>
        </div>
        <div class="flex items-center gap-2">
          <i class="bi bi-parking text-[#C2185B] text-lg"></i>
          <span class="text-sm text-gray-600 font-medium">{{ $contact->parking_info ?? 'Parkir luas' }}</span>
        </div>
      </div>
    </div>

  </div>
</section>

<!-- JavaScript untuk Filter Produk & Modal -->
<script>
    const waNumberGlobal = '{{ $waNumberGlobal }}';

    function filterProducts(category) {
        const products = document.querySelectorAll('.product-card');
        const resetBtn = document.getElementById('resetFilterBtn');
        const productsSection = document.getElementById('terlaris');
        const productsContainer = document.getElementById('productsContainer');

        const existingNoProductMsg = document.getElementById('noProductMessage');
        if (existingNoProductMsg) existingNoProductMsg.remove();

        if (category === 'all') {
            products.forEach(product => {
                product.style.display = 'block';
                product.style.animation = 'fadeIn 0.3s ease';
            });
            if (resetBtn) {
                resetBtn.classList.remove('bg-[#C2185B]', 'text-white');
                resetBtn.classList.add('bg-gray-200', 'text-gray-700');
            }
            document.querySelectorAll('.category-img').forEach(img => {
                img.classList.remove('border-[#C2185B]', 'scale-105');
                img.classList.add('border-transparent');
            });
            document.querySelectorAll('.category-name').forEach(name => {
                name.classList.remove('text-[#C2185B]', 'font-bold');
            });
        } else {
            let hasProducts = false;
            products.forEach(product => {
                const productCategory = product.getAttribute('data-category');
                if (productCategory === category) {
                    product.style.display = 'block';
                    product.style.animation = 'fadeIn 0.3s ease';
                    hasProducts = true;
                } else {
                    product.style.display = 'none';
                }
            });

            if (!hasProducts) {
                const noProductMessage = document.createElement('div');
                noProductMessage.id = 'noProductMessage';
                noProductMessage.className = 'col-span-full text-center py-12';
                noProductMessage.innerHTML = `
                    <div class="bg-yellow-50 border border-yellow-200 p-8 max-w-md mx-auto">
                        <i class="bi bi-emoji-frown text-5xl text-yellow-500 mb-4 block"></i>
                        <p class="text-gray-700 font-semibold text-lg">Belum Ada Produk</p>
                        <p class="text-gray-500 mt-2">Maaf, untuk kategori <span class="font-bold text-[#C2185B]">${category}</span> saat ini belum tersedia produk.</p>
                        <button onclick="filterProducts('all')" class="mt-4 px-4 py-2 bg-[#C2185B] text-white text-sm hover:bg-[#a0154a] transition">
                            Lihat Semua Produk
                        </button>
                    </div>
                `;
                productsContainer.appendChild(noProductMessage);
            }

            if (resetBtn) {
                resetBtn.classList.add('bg-[#C2185B]', 'text-white');
                resetBtn.classList.remove('bg-gray-200', 'text-gray-700');
            }
            document.querySelectorAll('.category-img').forEach(img => {
                if (img.getAttribute('data-category') === category) {
                    img.classList.add('border-[#C2185B]', 'scale-105');
                    img.classList.remove('border-transparent');
                } else {
                    img.classList.remove('border-[#C2185B]', 'scale-105');
                    img.classList.add('border-transparent');
                }
            });
            document.querySelectorAll('.category-name').forEach(name => {
                if (name.innerText === category) {
                    name.classList.add('text-[#C2185B]', 'font-bold');
                } else {
                    name.classList.remove('text-[#C2185B]', 'font-bold');
                }
            });
        }

        if (productsSection) {
            setTimeout(() => {
                productsSection.scrollIntoView({ behavior: 'smooth', block: 'start' });
            }, 150);
        }
    }

    // ===== MODAL DETAIL PRODUK =====
    function openProductModal(el) {
        const name = el.getAttribute('data-name') || '';
        const description = el.getAttribute('data-description') || '';
        const price = el.getAttribute('data-price') || '';
        const rating = parseFloat(el.getAttribute('data-rating')) || 0;
        const image = el.getAttribute('data-image') || '';

        document.getElementById('modalName').textContent = name;
        document.getElementById('modalDescription').textContent = description;
        document.getElementById('modalPrice').textContent = 'Rp ' + price;
        document.getElementById('modalImage').src = image;
        document.getElementById('modalImage').alt = name;

        const fullStars = Math.floor(rating);
        const hasHalf = rating - fullStars >= 0.5;
        let stars = '';
        for (let i = 1; i <= 5; i++) {
            if (i <= fullStars) stars += '★';
            else if (i === fullStars + 1 && hasHalf) stars += '½';
            else stars += '☆';
        }
        document.getElementById('modalRating').textContent = stars;
        document.getElementById('modalRatingValue').textContent = '(' + rating + ')';

        const message = 'Halo, saya mau pesan produk ' + name + ' dengan harga Rp ' + price;
        document.getElementById('modalWhatsapp').href =
            'https://wa.me/' + waNumberGlobal + '?text=' + encodeURIComponent(message);

        const modal = document.getElementById('productModal');
        modal.classList.remove('hidden');
        modal.classList.add('flex');
        document.body.style.overflow = 'hidden';
    }

    function closeProductModal() {
        const modal = document.getElementById('productModal');
        modal.classList.add('hidden');
        modal.classList.remove('flex');
        document.body.style.overflow = '';
    }

    document.getElementById('productModal').addEventListener('click', function(e) {
        if (e.target === this) closeProductModal();
    });

    document.addEventListener('keydown', function(e) {
        if (e.key === 'Escape') closeProductModal();
    });
</script>
<style>
    @keyframes fadeIn {
        from { opacity: 0; transform: translateY(10px); }
        to { opacity: 1; transform: translateY(0); }
    }
    .product-card { transition: all 0.3s ease; }
    .category-img { transition: all 0.3s ease; cursor: pointer; }
    .category-name { transition: all 0.3s ease; cursor: pointer; }
</style>

@endsection