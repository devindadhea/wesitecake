@extends('layouts.app')

@section('content')
<!-- HERO SECTION -->
<section id="beranda" class="pt-32 pb-24 max-w-7xl mx-auto px-4 md:px-6 grid md:grid-cols-2 gap-12 md:gap-16 items-center">
    <div class="text-center md:text-left">
        <h2 class="text-4xl md:text-5xl font-extrabold text-[#C2185B] leading-tight drop-shadow-sm">
            {{ $hero->title ?? 'Toko Roti Terbaik' }}<br />
            <span class="bg-gradient-to-r from-[#F8BBD9] to-[#C2185B] bg-clip-text text-transparent">
                {{ $hero->subtitle ?? 'Segar & Lezat' }}
            </span>
        </h2>
        <p class="mt-5 text-base md:text-lg text-gray-700 leading-relaxed">
            {{ $hero->description ?? 'Nikmati berbagai macam roti dan kue segar buatan tangan. Pesan online dengan mudah dan cepat.' }}
        </p>
        <a href="{{ $hero->button_link ?? '#terlaris' }}" class="inline-block mt-8 px-6 py-3 bg-[#C2185B] text-white font-semibold rounded-full hover:bg-[#d8408c] transition">
            {{ $hero->button_text ?? 'Lihat Produk' }}
        </a>
    </div>
    <div class="relative flex justify-center mt-6">
        <div class="absolute inset-0 flex justify-center items-center">
            <div class="w-[320px] md:w-[420px] h-[320px] md:h-[420px] rounded-full blur-3xl opacity-70 bg-[radial-gradient(circle_at_center,_#F8BBD9,_#C2185B)]"></div>
        </div>
        <img src="{{ $hero->strawberry_left_url ?? asset('images/s1.png') }}" class="absolute left-[10px] top-[40%] w-[85px] md:w-[110px] animate-3dfloat" alt="Strawberry">
        <img src="{{ $hero->strawberry_right_url ?? asset('images/s2.png') }}" class="absolute right-[10px] top-[55%] w-[100px] md:w-[110px] animate-3dfloat2" alt="Strawberry">
        <img src="{{ $hero->cake_image_url ?? asset('images/cake1.png') }}" alt="Cake" class="w-[260px] md:w-[330px] animate-half-rotate-3d z-[10]">
    </div>
</section>

<!-- CATEGORIES SECTION - JARAK KANAN KIRI RAPAT -->
<section id="kategori" class="py-16 bg-white">
    <div class="max-w-7xl mx-auto text-center px-2 md:px-4">
        <h3 class="text-3xl md:text-4xl font-extrabold text-[#C2185B] mt-1">Kategori Produk</h3>
        
  <div class="flex flex-wrap justify-center gap-2 md:gap-3 mt-8">
    @forelse($categories as $category)
    <div class="flex flex-col items-center cursor-pointer group w-[90px] md:w-[110px]" onclick="filterProducts('{{ $category->name }}')">
        <img src="{{ $category->image_url ?? asset('images/' . $category->image) }}" 
             class="w-16 h-16 md:w-20 md:h-20 rounded-full object-cover shadow-md hover:scale-105 transition-all duration-300 category-img border-2 border-transparent" 
             data-category="{{ $category->name }}"
             alt="{{ $category->name }}">
        <p class="font-semibold text-sm md:text-base mt-2 text-gray-700 category-name text-center">{{ $category->name }}</p>
    </div>
    @empty
        <p class="text-gray-500">No categories found</p>
    @endforelse
</div>
        
        <!-- Tombol Reset Filter -->
        <div class="flex justify-center mt-8">
            <button onclick="filterProducts('all')" 
                    id="resetFilterBtn"
                    class="px-6 py-2  bg-[#C2185B] text-white font-semibold rounded-full   transition shadow-md">
                Tampilkan Semua Produk
            </button>
        </div>
    </div>
</section>

<!-- PRODUCTS SECTION -->
<section id="terlaris" class="relative py-20 max-w-7xl mx-auto px-4 md:px-6">
    <h3 class="text-3xl md:text-4xl font-extrabold text-[#C2185B] text-center mb-12 tracking-wide">Produk</h3>
    <div class="grid grid-cols-3 md:grid-cols-5 gap-3 md:gap-6" id="productsContainer">
        @forelse($allProducts as $product)
        <div class="product-card group bg-white rounded-xl md:rounded-2xl p-2 md:p-4 shadow-md hover:shadow-xl border border-pink-200/40 transition-all duration-300" data-category="{{ $product->category }}">
            <img src="{{ $product->image_url ?? asset('images/' . $product->image) }}" 
                 class="w-full h-24 md:h-40 object-cover rounded-lg md:rounded-xl mb-1 md:mb-4 group-hover:scale-[1.03] transition" 
                 alt="{{ $product->name }}">
            <h4 class="text-xs md:text-lg font-semibold text-[#C2185B] line-clamp-1">{{ Str::limit($product->name, 15) }}</h4>
            <p class="text-gray-600 text-[10px] md:text-sm mt-0.5 md:mt-1 leading-relaxed hidden md:line-clamp-2">{{ Str::limit($product->description, 40) }}</p>
            <div class="flex items-center mt-0.5 md:mt-2">
                <span class="text-yellow-500 text-[8px] md:text-base">
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
                <span class="text-[8px] md:text-xs text-gray-500 ml-0.5 md:ml-2">({{ $product->rating }})</span>
            </div>
            <p class="text-[10px] md:text-base font-bold text-[#C2185B] mt-0.5 md:mt-2">Rp {{ number_format($product->price, 0, ',', '.') }}</p>
        </div>
        @empty
            <p class="col-span-3 md:col-span-5 text-center text-gray-500">No products found</p>
        @endforelse
    </div>
</section>
<!-- ABOUT SECTION -->
<section id="tentang" class="relative py-24 max-w-7xl mx-auto px-4 md:px-6">
    
    <!-- Desktop Layout  -->
    <div class="hidden md:grid md:grid-cols-2 items-center gap-4 md:gap-6">
        <div class="relative order-1 flex justify-start">
            <img src="{{ $about->image_url ?? asset('images/c8.png') }}" 
                 class="rounded-lg w-52 md:w-72 lg:w-[450px] object-cover md:-ml-6 lg:-ml-10 drop-shadow-xl" 
                 alt="Tentang Toko">
        </div>
        <div class="order-2 md:-ml-8 lg:-ml-12">
            <h3 class="text-3xl md:text-4xl font-bold text-[#C2185B] leading-tight">{{ $about->title ?? 'Tentang Pit Bolu' }}</h3>
            <p class="mt-5 text-gray-700 leading-relaxed text-base md:text-lg">{{ $about->description ?? 'Pita Bolu adalah toko roti modern yang menyediakan produk segar buatan tangan. Kami fokus pada kualitas bahan dan rasa yang autentik.' }}</p>
            <ul class="mt-6 space-y-4 text-gray-700 text-base md:text-lg">
                @forelse($features as $feature)
                <li class="flex items-center gap-3">
                    <span class="w-7 h-7 flex items-center justify-center rounded-full bg-[#C2185B] text-pink-100 shadow-md">
                    <p class= >{{ $feature->icon}}</p>
                    </span>
                    {{ $feature->title }}
                </li>
                @empty
                    <li>No features found</li>
                @endforelse
            </ul>
        </div>
    </div>

    <!-- Mobile Layout (di bawah md) -->
    <div class="block md:hidden">
        <!-- Judul -->
        <h3 class="text-3xl font-bold text-[#C2185B] leading-tight text-center mb-6">{{ $about->title ?? 'Tentang Pit Bolu' }}</h3>
        
        <!-- Deskripsi -->
        <p class="text-gray-700 leading-relaxed text-base mb-6">{{ $about->description ?? 'Pita Bolu adalah toko roti modern yang menyediakan produk segar buatan tangan. Kami fokus pada kualitas bahan dan rasa yang autentik.' }}</p>
        
        <!-- Gambar di Tengah -->
        <div class="flex justify-center my-6">
            <img src="{{ $about->image_url ?? asset('images/c8.png') }}" 
                 class="w-full rounded-xl shadow-lg" 
                 alt="Tentang Toko">
        </div>
        
        <!-- List Features -->
        <ul class="mt-6 space-y-4 text-gray-700 text-base">
            @forelse($features as $feature)
            <li class="flex items-center gap-3">
                <span class="w-7 h-7 flex items-center justify-center rounded-full bg-[#C2185B] text-pink-100 shadow-md">
                    <p class= >{{ $feature->icon}}</p>
                </span>
                {{ $feature->title }}
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

  <h3 class="text-3xl md:text-4xl font-extrabold text-[#C2185B] text-center mb-12">Kontak & Lokasi</h3>
  
  <div class="grid md:grid-cols-2 gap-8">
    
    <div class="space-y-8">
      
      <div class="bg-white rounded-2xl p-6 shadow-md border border-pink-200/40">
        <h4 class="text-xl font-bold text-[#C2185B] mb-4 flex items-center gap-2">
          <i class="bi bi-clock"></i>
          Jam Operasi
        </h4>
        <div class="space-y-3">
          @forelse($businessHours as $hour)
          <div class="flex justify-between items-center py-2 border-b border-gray-100">
            <span class="text-gray-700">{{ $hour->day }}</span>
            <span class="font-semibold text-[#C2185B]">{{ $hour->open_time }} - {{ $hour->close_time }}</span>
          </div>
          @empty
          <div class="flex justify-between items-center py-2 border-b border-gray-100">
            <span class="text-gray-700">Senin - Jumat</span>
            <span class="font-semibold text-[#C2185B]">08:00 - 20:00</span>
          </div>
          <div class="flex justify-between items-center py-2 border-b border-gray-100">
            <span class="text-gray-700">Sabtu - Minggu</span>
            <span class="font-semibold text-[#C2185B]">08:00 - 22:00</span>
          </div>
          @endforelse
          <p class="text-sm text-gray-500 mt-4">
            <i class="bi bi-info-circle"></i>
            Kami buka setiap hari termasuk hari libur
          </p>
        </div>
      </div>
      
      <div class="bg-white rounded-2xl p-6 shadow-md border border-pink-200/40">
        <h4 class="text-xl font-bold text-[#C2185B] mb-4 flex items-center gap-2">
          <i class="bi bi-whatsapp"></i>
          Pesan via WhatsApp
        </h4>
        <p class="text-gray-600 mb-4">
          Langsung chat kami untuk pemesanan atau konsultasi produk
        </p>
        <div class="space-y-3 mb-6">
          <div class="flex items-center gap-3">
            <div class="w-10 h-10 bg-pink-100 rounded-full flex items-center justify-center">
              <i class="bi bi-phone text-pink-600"></i>
            </div>
            <div>
              <p class="text-sm text-gray-500">Nomor WhatsApp</p>
              <p class="font-bold text-gray-800">{{ $contact->whatsapp_number ?? '+62 812 3456 7890' }}</p>
            </div>
          </div>
        </div>
        @php
            $waNumber = preg_replace('/[^0-9]/', '', $contact->whatsapp_number ?? '+62 812 3456 7890');
            $waMessage = $contact->whatsapp_message ?? 'Halo%Pita Bolu,%20saya%20mau%20tanya%20tentang%20produk%20dan%20pesanan';
        @endphp
        <a 
          href="https://wa.me/{{ $waNumber }}?text={{ $waMessage }}"
          target="_blank"
          class="inline-flex items-center gap-2 w-full justify-center bg-[#C2185B] hover:bg-pink-600 text-white font-semibold py-3 px-4 rounded-full transition"
        >
          <i class="bi bi-whatsapp text-lg"></i>
          Chat Sekarang
        </a>
      </div>
      
    </div>
    
    <div class="bg-white rounded-2xl p-6 shadow-md border border-pink-200/40">
      <h4 class="text-xl font-bold text-[#C2185B] mb-4 flex items-center gap-2">
        <i class="bi bi-geo-alt"></i>
        Lokasi Toko
      </h4>
      <p class="text-gray-600 mb-4">
        Kunjungi toko kami di alamat berikut:
      </p>
      <div class="mb-4">
        <p class="font-medium text-gray-800">
          {{ $contact->address ?? 'Jl. Raya Bandung No. 123, Bandung, Jawa Barat' }}
        </p>
      </div>
      
      <div class="bg-gray-200 rounded-xl h-64 md:h-80 flex items-center justify-center overflow-hidden">
        @if(!empty($contact->maps_embed))
          <iframe 
            src="{{ $contact->maps_embed }}"
            width="100%" 
            height="100%" 
            style="border:0;" 
            allowfullscreen="" 
            loading="lazy"
            class="rounded-lg"
          ></iframe>
        @else
          <iframe 
            src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3960.731997569548!2d107.6181271!3d-6.917586!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x2e68e62c3e3b44d1%3A0x654b78d6d0d0b2b9!2sBandung!5e0!3m2!1sen!2sid!4v1632987654321!5m2!1sen!2sid"
            width="100%" 
            height="100%" 
            style="border:0;" 
            allowfullscreen="" 
            loading="lazy"
            class="rounded-lg"
          ></iframe>
        @endif
      </div>
      
      <div class="mt-4 flex flex-wrap gap-4">
        <div class="flex items-center gap-2">
          <i class="bi bi-truck text-[#C2185B]"></i>
          <span class="text-sm text-gray-600">{{ $contact->delivery_info ?? 'Gratis ongkir area Bandung' }}</span>
        </div>
        <div class="flex items-center gap-2">
          <i class="bi bi-parking text-[#C2185B]"></i>
          <span class="text-sm text-gray-600">{{ $contact->parking_info ?? 'Parkir luas' }}</span>
        </div>
      </div>
    </div>
    
  </div>
</section>

<!-- JavaScript untuk Filter Produk -->
<script>
    function filterProducts(category) {
        const products = document.querySelectorAll('.product-card');
        const resetBtn = document.getElementById('resetFilterBtn');
        const productsSection = document.getElementById('terlaris');
        const productsContainer = document.getElementById('productsContainer');
        
        // Cek apakah ada tombol "Belum Ada Produk" yang sudah ada, hapus dulu
        const existingNoProductMsg = document.getElementById('noProductMessage');
        if (existingNoProductMsg) {
            existingNoProductMsg.remove();
        }
        
        if (category === 'all') {
            // Tampilkan semua produk
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
            // Filter produk berdasarkan kategori
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
            
            // Jika tidak ada produk, tampilkan pesan
            if (!hasProducts) {
                const noProductMessage = document.createElement('div');
                noProductMessage.id = 'noProductMessage';
                noProductMessage.className = 'col-span-full text-center py-12';
                noProductMessage.innerHTML = `
                    <div class="bg-yellow-50 border border-yellow-200 rounded-lg p-8 max-w-md mx-auto">
                        <i class="bi bi-emoji-frown text-5xl text-yellow-500 mb-4 block"></i>
                        <p class="text-gray-700 font-semibold text-lg">Belum Ada Produk</p>
                        <p class="text-gray-500 mt-2">Maaf, untuk kategori <span class="font-bold text-[#C2185B]">${category}</span> saat ini belum tersedia produk.</p>
                        <button onclick="filterProducts('all')" class="mt-4 px-4 py-2 bg-[#C2185B] text-white rounded-full text-sm hover:bg-[#d8408c] transition">
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
        
        // SCROLL KE SECTION PRODUK
        if (productsSection) {
            setTimeout(() => {
                productsSection.scrollIntoView({ 
                    behavior: 'smooth', 
                    block: 'start' 
                });
            }, 150);
        }
    }
</script>
<style>
    @keyframes fadeIn {
        from {
            opacity: 0;
            transform: translateY(10px);
        }
        to {
            opacity: 1;
            transform: translateY(0);
        }
    }
    
    .product-card {
        transition: all 0.3s ease;
    }
    
    .category-img {
        transition: all 0.3s ease;
        cursor: pointer;
    }
    
    .category-name {
        transition: all 0.3s ease;
        cursor: pointer;
    }
</style>

@endsection