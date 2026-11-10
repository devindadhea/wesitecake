@extends('layouts.app')

@section('content')

@php
    $contactGlobal = \App\Models\Contact::first();
    $waNumberGlobal = preg_replace('/[^0-9]/', '', $contactGlobal->whatsapp_number ?? '6281234567890');
    if (str_starts_with($waNumberGlobal, '0')) {
        $waNumberGlobal = '62' . substr($waNumberGlobal, 1);
    }
@endphp

<!-- HERO SECTION -->
<section id="beranda" class="relative pt-32 pb-24 max-w-7xl mx-auto px-4 md:px-6 grid md:grid-cols-2 gap-12 md:gap-16 items-center">
    <div class="text-center md:text-left">
        <span class="inline-block text-[11px] md:text-xs font-semibold tracking-[0.25em] text-[#C2185B]/70 uppercase mb-4 bg-[#FCE4EC] px-4 py-2 rounded-full">Toko Roti Modern</span>
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
           class="inline-flex items-center gap-2 mt-8 px-8 py-4 bg-[#C2185B] text-white font-semibold hover:bg-[#a0154a] transition-colors duration-300 shadow-lg rounded-full">
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
    <img src="{{ $hero->cake_image_url ?? asset('images/cake1.png') }}" alt="Cake" class="w-[260px] md:w-[330px] aspect-square object-cover rounded-full animate-half-rotate-3d z-[10] shadow-2xl">
</div>`
</section>

<!-- CATEGORIES SECTION -->
<section id="kategori" class="py-16 md:py-20 bg-white">
    <div class="max-w-7xl mx-auto text-center px-4 md:px-6">
        <span class="inline-block text-[11px] md:text-xs font-semibold tracking-[0.25em] text-[#C2185B]/70 uppercase mb-2">Pilih Kategori</span>
        <h2 class="text-2xl md:text-4xl font-extrabold text-[#C2185B] tracking-tight">Kategori Produk</h2>
        <p class="mt-2 text-sm md:text-base text-gray-500 max-w-xl mx-auto">Pilih kategori untuk melihat produk yang Anda inginkan.</p>

        <div class="flex flex-wrap justify-center gap-4 md:gap-6 mt-10">
            @forelse($categories as $category)
            <button type="button"
                    class="flex flex-col items-center cursor-pointer group w-[90px] md:w-[120px] focus:outline-none"
                    onclick="filterProducts('{{ $category->name }}')"
                    aria-label="Filter kategori {{ $category->name }}">
                <div class="p-1 rounded-full bg-gradient-to-br from-[#F8BBD9] to-[#C2185B] group-hover:scale-105 transition-transform duration-300 shadow-sm">
                    <img src="{{ $category->image_url ?? asset('images/' . $category->image) }}" 
                         class="w-16 h-16 md:w-24 md:h-24 rounded-full object-cover bg-white category-img border-4 border-white" 
                         data-category="{{ $category->name }}"
                         alt="{{ $category->name }}">
                </div>
                <span class="font-semibold text-sm md:text-base mt-2 text-gray-700 category-name text-center group-hover:text-[#C2185B] transition-colors duration-300">{{ $category->name }}</span>
            </button>
            @empty
                <p class="text-gray-500">No categories found</p>
            @endforelse
        </div>

        <div class="flex justify-center mt-10">
            <button onclick="filterProducts('all')" 
                    id="resetFilterBtn"
                    class="inline-flex items-center gap-2 px-6 py-3 bg-[#C2185B] hover:bg-[#a0154a] text-white font-semibold rounded-full transition-colors duration-300 shadow-md">
                <i class="bi bi-arrow-counterclockwise"></i>
                Tampilkan Semua Produk
            </button>
        </div>
    </div>
</section>

<!-- PRODUCTS SECTION -->
<section id="terlaris" class="relative py-16 md:py-20 bg-gradient-to-b from-[#FFF5F7] to-white">
    <div class="max-w-7xl mx-auto px-4 md:px-6">
        <div class="text-center mb-10 md:mb-14">
            <span class="inline-block text-[11px] md:text-xs font-semibold tracking-[0.25em] text-[#C2185B]/70 uppercase mb-2">Menu Kami</span>
            <h2 class="text-2xl md:text-4xl font-extrabold text-[#C2185B] tracking-tight">Produk Terbaik</h2>
            <p class="mt-2 text-sm md:text-base text-gray-500 max-w-xl mx-auto">Dibuat segar setiap hari. Klik produk untuk melihat detail dan memesan.</p>
        </div>

        <div class="grid grid-cols-2 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-4 xl:grid-cols-5 gap-3 md:gap-6" id="productsContainer">
            @forelse($allProducts as $product)
            <button type="button"
                 class="product-card group bg-white overflow-hidden shadow-sm hover:shadow-xl transition-all duration-300 hover:-translate-y-1 cursor-pointer text-left rounded-2xl border border-gray-100 focus:outline-none focus:ring-2 focus:ring-[#C2185B]/40" 
                 data-category="{{ $product->category }}"
                 data-name="{{ $product->name }}"
                 data-description="{{ $product->description }}"
                 data-price="{{ number_format($product->price, 0, ',', '.') }}"
                 data-rating="{{ $product->rating }}"
                 data-image="{{ $product->image_url ?? asset('images/' . $product->image) }}"
                 onclick="openProductModal(this)"
                 aria-label="Lihat detail {{ $product->name }}">
                <div class="relative overflow-hidden rounded-t-2xl">
                    <img src="{{ $product->image_url ?? asset('images/' . $product->image) }}" 
                         class="w-full h-36 md:h-48 object-cover group-hover:scale-105 transition-transform duration-500" 
                         alt="{{ $product->name }}"
                         loading="lazy">
                    <span class="absolute top-2 left-2 bg-white/95 text-[#C2185B] text-[10px] md:text-xs font-semibold px-2.5 py-1 rounded-full shadow-sm">
                        {{ $product->category }}
                    </span>
                </div>
                <div class="p-3 md:p-4">
                    <h3 class="text-sm md:text-base font-bold text-gray-800 line-clamp-1 tracking-tight group-hover:text-[#C2185B] transition-colors">{{ Str::limit($product->name, 20) }}</h3>
                    <p class="text-gray-500 text-[11px] md:text-xs mt-1 leading-relaxed hidden md:line-clamp-2">{{ Str::limit($product->description, 50) }}</p>
                    <div class="flex items-center mt-2">
                        <span class="text-yellow-500 text-[10px] md:text-sm tracking-tight">
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
                        <span class="text-[10px] md:text-xs text-gray-400 ml-1.5">({{ $product->rating }})</span>
                    </div>
                    <p class="text-base md:text-lg font-extrabold text-[#C2185B] mt-2 tracking-wide">Rp {{ number_format($product->price, 0, ',', '.') }}</p>
                    <span class="mt-2 inline-flex items-center gap-1 text-[11px] md:text-xs font-semibold text-[#C2185B]">
                        <i class="bi bi-eye"></i> Lihat Detail
                    </span>
                </div>
            </button>
            @empty
                <p class="col-span-2 md:col-span-5 text-center text-gray-500 py-10">No products found</p>
            @endforelse
        </div>
    </div>

    <!-- MODAL DETAIL PRODUK -->
    <div id="productModal" class="fixed inset-0 z-[100] hidden items-center justify-center p-4 bg-black/60 backdrop-blur-sm" role="dialog" aria-modal="true" aria-labelledby="modalName">
        <div class="bg-white max-w-3xl w-full max-h-[92vh] overflow-y-auto shadow-2xl relative rounded-3xl overflow-hidden" onclick="event.stopPropagation()">
            <button onclick="closeProductModal()" 
                    class="absolute top-3 right-3 z-10 w-10 h-10 flex items-center justify-center bg-white/95 text-gray-700 hover:bg-[#C2185B] hover:text-white transition-colors duration-300 shadow-md rounded-full"
                    aria-label="Tutup detail produk">
                <i class="bi bi-x-lg"></i>
            </button>
            <div class="grid md:grid-cols-2">
                <div class="bg-[#FFF5F7] aspect-square md:aspect-auto md:min-h-[380px] flex items-center justify-center p-4 md:p-6 rounded-t-3xl md:rounded-l-3xl md:rounded-tr-none">
                    <img id="modalImage" src="" alt="" class="w-full h-full object-contain drop-shadow-lg rounded-2xl">
                </div>
                <div class="p-5 md:p-8 flex flex-col">
                    <span class="inline-block text-[11px] font-semibold tracking-[0.25em] text-[#C2185B]/70 uppercase mb-2">Detail Produk</span>
                    <h3 id="modalName" class="text-xl md:text-3xl font-extrabold text-[#C2185B] tracking-tight leading-tight"></h3>
                    <div class="flex items-center mt-2">
                        <span id="modalRating" class="text-yellow-500 text-base tracking-tight"></span>
                        <span id="modalRatingValue" class="text-sm text-gray-500 ml-2"></span>
                    </div>
                    <p id="modalDescription" class="mt-4 text-gray-600 leading-relaxed text-sm md:text-base"></p>
                    <div class="mt-auto pt-5">
                        <p class="text-xs uppercase tracking-wider text-gray-500 font-semibold mb-1">Harga</p>
                        <p id="modalPrice" class="text-2xl md:text-3xl font-extrabold text-[#C2185B] tracking-tight"></p>
                    </div>
                    <a id="modalWhatsapp" href="#" target="_blank"
                       class="mt-4 inline-flex items-center justify-center gap-2 w-full bg-[#C2185B] hover:bg-[#a0154a] text-white font-semibold py-3.5 px-4 transition-colors duration-300 rounded-full shadow-md">
                        <i class="bi bi-whatsapp text-lg"></i>
                        Pesan via WhatsApp
                    </a>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- ABOUT SECTION -->
<section id="tentang" class="relative py-16 md:py-24 bg-white overflow-hidden">

    <!-- Ornamen dekoratif -->
    <div class="absolute -top-20 -right-20 w-64 h-64 md:w-96 md:h-96 rounded-full bg-[#FCE4EC]/60 blur-3xl pointer-events-none"></div>
    <div class="absolute -bottom-24 -left-20 w-64 h-64 md:w-96 md:h-96 rounded-full bg-[#F8BBD9]/40 blur-3xl pointer-events-none"></div>

    @php
        $iconMap = [
            'bahan' => 'bi-basket2', 'segar' => 'bi-flower1', 'fresh' => 'bi-flower1',
            'handmade' => 'bi-hand-thumbs-up', 'tangan' => 'bi-hand-thumbs-up', 'buatan' => 'bi-hand-thumbs-up',
            'kualitas' => 'bi-patch-check', 'quality' => 'bi-patch-check', 'halal' => 'bi-check2-circle',
            'higienis' => 'bi-shield-check', 'sehat' => 'bi-heart-pulse', 'cepat' => 'bi-lightning-charge',
            'antar' => 'bi-truck', 'kirim' => 'bi-truck', 'harga' => 'bi-tag', 'murah' => 'bi-tag',
            'varian' => 'bi-grid-3x3-gap', 'lengkap' => 'bi-grid-3x3-gap', 'rasa' => 'bi-emoji-smile',
            'enak' => 'bi-emoji-smile', 'cinta' => 'bi-heart', 'love' => 'bi-heart',
            'lokasi' => 'bi-geo-alt', 'toko' => 'bi-shop', 'modern' => 'bi-phone',
            'tampilan' => 'bi-phone', 'mudah' => 'bi-hand-index-thumb',
        ];
        $resolveIcon = function ($title) use ($iconMap) {
            $t = strtolower($title ?? '');
            foreach ($iconMap as $keyword => $icon) {
                if (str_contains($t, $keyword)) return 'bi ' . $icon;
            }
            return 'bi bi-star';
        };
    @endphp

    <div class="relative max-w-7xl mx-auto px-4 md:px-6 grid md:grid-cols-2 items-center gap-10 md:gap-16">

        <!-- Gambar -->
        <div class="order-1 relative">
            <div class="absolute -inset-3 md:-inset-4 bg-gradient-to-br from-[#FCE4EC] to-[#F8BBD9]/40 rounded-[2rem] -z-10"></div>
            <img src="{{ $about->image_url ?? asset('images/c8.png') }}" 
                 class="w-full max-w-[520px] mx-auto aspect-square object-cover shadow-2xl rounded-[2rem]" 
                 alt="Tentang Toko"
                 loading="lazy">
        </div>

        <!-- Teks -->
        <div class="order-2 text-center md:text-left">
            <span class="inline-flex items-center gap-2 text-[11px] md:text-xs font-semibold tracking-[0.25em] text-[#C2185B] uppercase bg-[#FCE4EC] px-4 py-2 rounded-full mb-4">
                <i class="bi bi-stars"></i> Tentang Kami
            </span>
            <h2 class="text-2xl md:text-4xl lg:text-5xl font-extrabold text-[#C2185B] leading-tight tracking-tight">
                {{ $about->title ?? 'Tentang Herlina Cookies & Cakes' }}
            </h2>
            <p class="mt-4 text-gray-600 leading-relaxed text-sm md:text-lg">
                {{ $about->description ?? 'Herlina Cookies & Cakes adalah toko roti modern yang menyediakan produk segar buatan tangan. Kami fokus pada kualitas bahan dan rasa yang autentik.' }}
            </p>

            <!-- Fitur -->
            <div class="mt-8 grid grid-cols-1 sm:grid-cols-2 gap-3">
                @forelse($features as $feature)
                <div class="flex items-center gap-3 bg-white border border-pink-100 rounded-2xl px-4 py-3 shadow-sm hover:shadow-md hover:-translate-y-0.5 transition-all duration-300">
                    <span class="w-9 h-9 flex items-center justify-center bg-[#C2185B] text-white rounded-full shrink-0">
                        <i class="{{ $resolveIcon($feature->title) }} text-sm leading-none"></i>
                    </span>
                    <span class="font-semibold text-sm md:text-base text-gray-700 text-left">{{ $feature->title }}</span>
                </div>
                @empty
                    <p class="text-gray-500">No features found</p>
                @endforelse
            </div>
        </div>

    </div>
</section>
<!-- KONTAK & LOKASI SECTION -->
<section id="kontak" class="relative py-16 md:py-20 bg-[#FFF5F7]">
  @php
      $contact = \App\Models\Contact::first();
      $businessHours = \App\Models\BusinessHour::orderBy('order')->get();
  @endphp

  <div class="max-w-7xl mx-auto px-4 md:px-6">
    <div class="text-center mb-10 md:mb-12">
        <span class="inline-block text-[11px] md:text-xs font-semibold tracking-[0.25em] text-[#C2185B]/70 uppercase mb-2">Hubungi Kami</span>
        <h2 class="text-2xl md:text-4xl font-extrabold text-[#C2185B] tracking-tight">Kontak & Lokasi</h2>
        <p class="mt-2 text-sm md:text-base text-gray-500 max-w-xl mx-auto">Kami siap membantu pesanan dan pertanyaan Anda setiap hari.</p>
    </div>

    <div class="grid md:grid-cols-2 gap-6 md:gap-8">

      <div class="space-y-6">

        <!-- Jam Operasi -->
        <div class="bg-white p-5 md:p-7 shadow-sm rounded-3xl border border-pink-100">
          <h3 class="text-lg md:text-xl font-bold text-[#C2185B] mb-4 flex items-center gap-3">
            <span class="w-10 h-10 flex items-center justify-center bg-[#C2185B] text-white rounded-full shrink-0">
              <i class="bi bi-clock"></i>
            </span>
            Jam Operasi
          </h3>
          <div class="space-y-2">
            @forelse($businessHours as $hour)
            <div class="flex justify-between items-center py-2 border-b border-gray-100 last:border-0">
              <span class="text-gray-600 text-sm md:text-base">{{ $hour->day }}</span>
              <span class="font-semibold text-[#C2185B] text-sm md:text-base">{{ $hour->open_time }} - {{ $hour->close_time }}</span>
            </div>
            @empty
            <div class="flex justify-between items-center py-2 border-b border-gray-100">
              <span class="text-gray-600 text-sm md:text-base">Senin - Jumat</span>
              <span class="font-semibold text-[#C2185B] text-sm md:text-base">08:00 - 20:00</span>
            </div>
            <div class="flex justify-between items-center py-2 border-b border-gray-100">
              <span class="text-gray-600 text-sm md:text-base">Sabtu - Minggu</span>
              <span class="font-semibold text-[#C2185B] text-sm md:text-base">08:00 - 22:00</span>
            </div>
            @endforelse
            <p class="text-xs md:text-sm text-gray-500 mt-3 flex items-start gap-2">
              <i class="bi bi-info-circle text-[#C2185B] mt-0.5"></i>
              <span>Kami buka setiap hari termasuk hari libur</span>
            </p>
          </div>
        </div>

        <!-- WhatsApp -->
        <div class="bg-white p-5 md:p-7 shadow-sm rounded-3xl border border-pink-100">
          <h3 class="text-lg md:text-xl font-bold text-[#C2185B] mb-4 flex items-center gap-3">
            <span class="w-10 h-10 flex items-center justify-center bg-[#C2185B] text-white rounded-full shrink-0">
              <i class="bi bi-whatsapp"></i>
            </span>
            Pesan via WhatsApp
          </h3>
          <p class="text-gray-600 mb-4 text-sm md:text-base">
            Langsung chat kami untuk pemesanan atau konsultasi produk.
          </p>
          <div class="mb-4">
            <div class="flex items-center gap-3">
              <div class="w-10 h-10 bg-[#FCE4EC] flex items-center justify-center rounded-full shrink-0">
                <i class="bi bi-phone text-[#C2185B]"></i>
              </div>
              <div>
                <p class="text-[11px] uppercase tracking-wider text-gray-500 font-semibold">Nomor WhatsApp</p>
                <p class="font-bold text-gray-800 text-sm md:text-base">{{ $contact->whatsapp_number ?? '+62 812 3456 7890' }}</p>
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
          <a href="https://wa.me/{{ $waNumber }}?text={{ $waMessage }}"
             target="_blank"
             rel="noopener"
             class="inline-flex items-center gap-2 w-full justify-center bg-[#C2185B] hover:bg-[#a0154a] text-white font-semibold py-3 px-4 transition-colors duration-300 rounded-full shadow-md">
            <i class="bi bi-whatsapp text-lg"></i>
            Pesan Sekarang
          </a>
        </div>

      </div>

      <!-- Lokasi -->
      <div class="bg-white p-5 md:p-7 shadow-sm rounded-3xl border border-pink-100 flex flex-col">
        <h3 class="text-lg md:text-xl font-bold text-[#C2185B] mb-4 flex items-center gap-3">
          <span class="w-10 h-10 flex items-center justify-center bg-[#C2185B] text-white rounded-full shrink-0">
            <i class="bi bi-geo-alt"></i>
          </span>
          Lokasi Toko
        </h3>

        <p class="text-gray-600 mb-2 text-sm md:text-base">Kunjungi toko kami di alamat berikut:</p>
        <p class="font-semibold text-gray-800 mb-4 text-sm md:text-base">
          {{ $contact->address ?? 'Jl. Raya Bandung No. 123, Bandung, Jawa Barat' }}
        </p>

        <div class="relative overflow-hidden border border-gray-200 shadow-sm flex-1 min-h-[280px] md:min-h-[340px] rounded-2xl">
          @if(!empty($contact->maps_embed))
            <iframe src="{{ $contact->maps_embed }}"
                    width="100%" height="100%"
                    style="border:0;" allowfullscreen="" loading="lazy"
                    title="Lokasi toko di Google Maps"
                    class="w-full h-full rounded-2xl"></iframe>
          @else
            <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3960.731997569548!2d107.6181271!3d-6.917586!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x2e68e62c3e3b44d1%3A0x654b78d6d0d0b2b9!2sBandung!5e0!3m2!1sen!2sid!4v1632987654321!5m2!1sen!2sid"
                    width="100%" height="100%"
                    style="border:0;" allowfullscreen="" loading="lazy"
                    title="Lokasi toko di Google Maps"
                    class="w-full h-full rounded-2xl"></iframe>
          @endif
        </div>

        <div class="mt-4 flex flex-wrap gap-2">
          <span class="inline-flex items-center gap-2 bg-[#FCE4EC] px-3 py-2 rounded-full text-xs md:text-sm text-gray-700">
            <i class="bi bi-truck text-[#C2185B]"></i>
            {{ $contact->delivery_info ?? 'Gratis ongkir area Bandung' }}
          </span>
          <span class="inline-flex items-center gap-2 bg-[#FCE4EC] px-3 py-2 rounded-full text-xs md:text-sm text-gray-700">
            <i class="bi bi-parking text-[#C2185B]"></i>
            {{ $contact->parking_info ?? 'Parkir luas' }}
          </span>
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
                resetBtn.classList.remove('bg-gray-200', 'text-gray-700');
                resetBtn.classList.add('bg-[#C2185B]', 'text-white');
            }
            document.querySelectorAll('.category-img').forEach(img => {
                img.classList.remove('border-[#C2185B]', 'scale-105');
                img.classList.add('border-white');
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
                    <div class="bg-yellow-50 border border-yellow-200 p-6 md:p-8 max-w-md mx-auto rounded-3xl">
                        <i class="bi bi-emoji-frown text-4xl md:text-5xl text-yellow-500 mb-3 block"></i>
                        <p class="text-gray-700 font-semibold text-base md:text-lg">Belum Ada Produk</p>
                        <p class="text-gray-500 mt-2 text-sm">Maaf, untuk kategori <span class="font-bold text-[#C2185B]">${category}</span> saat ini belum tersedia produk.</p>
                        <button onclick="filterProducts('all')" class="mt-4 px-5 py-2.5 bg-[#C2185B] text-white text-sm hover:bg-[#a0154a] transition rounded-full">
                            Lihat Semua Produk
                        </button>
                    </div>
                `;
                productsContainer.appendChild(noProductMessage);
            }

            if (resetBtn) {
                resetBtn.classList.add('bg-gray-200', 'text-gray-700');
                resetBtn.classList.remove('bg-[#C2185B]', 'text-white');
            }
            document.querySelectorAll('.category-img').forEach(img => {
                if (img.getAttribute('data-category') === category) {
                    img.classList.add('border-[#C2185B]', 'scale-105');
                    img.classList.remove('border-white');
                } else {
                    img.classList.remove('border-[#C2185B]', 'scale-105');
                    img.classList.add('border-white');
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
        from { opacity: 0; transform: translateY(8px); }
        to { opacity: 1; transform: translateY(0); }
    }
    .product-card { transition: all 0.3s ease; }
    .category-img { transition: all 0.3s ease; cursor: pointer; }
    .category-name { transition: all 0.3s ease; cursor: pointer; }
    #resetFilterBtn.bg-gray-200 { background-color: #e5e7eb !important; color: #374151 !important; }
</style>

@endsection