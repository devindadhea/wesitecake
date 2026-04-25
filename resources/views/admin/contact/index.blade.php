@extends('layouts.app')

@section('title', 'Contact Settings - BakeryChrips')

@section('content')
<div class="pt-24 pb-12 max-w-7xl mx-auto px-4 md:px-6">
    <div class="flex items-center mb-8">
        <a href="{{ route('admin.dashboard') }}" class="text-[#C2185B] hover:underline mr-4">
            <i class="bi bi-arrow-left"></i> Back to Dashboard
        </a>
        <h1 class="text-3xl font-bold text-[#C2185B]">Contact Settings</h1>
    </div>

    @if(session('success'))
        <div class="mb-4 p-4 bg-green-100 text-green-700 rounded-lg">
            {{ session('success') }}
        </div>
    @endif

    <div class="grid grid-cols-1 lg:grid-cols-2 gap-6">
        <!-- Contact Information Form -->
        <div class="bg-white rounded-lg shadow p-6">
            <h2 class="text-xl font-bold text-[#C2185B] mb-4">Contact Information</h2>
            
            <form action="{{ route('admin.contact.update') }}" method="POST">
                @csrf

                <div class="mb-4">
                    <label class="block text-gray-700 text-sm font-bold mb-2">WhatsApp Number</label>
                    <input type="text" name="whatsapp_number" value="{{ $contact->whatsapp_number ?? '+62 812 3456 7890' }}" required 
                           class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:outline-none focus:border-[#C2185B]">
                </div>

                <div class="mb-4">
                    <label class="block text-gray-700 text-sm font-bold mb-2">WhatsApp Message (URL encoded)</label>
                    <input type="text" name="whatsapp_message" value="{{ $contact->whatsapp_message ?? 'Halo%20BakeryChrips,%20saya%20mau%20tanya%20tentang%20produk%20dan%20pesanan' }}" 
                           class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:outline-none focus:border-[#C2185B]">
                    <p class="text-xs text-gray-500 mt-1">Gunakan %20 untuk spasi</p>
                </div>

                <div class="mb-4">
                    <label class="block text-gray-700 text-sm font-bold mb-2">Address</label>
                    <textarea name="address" rows="2" required 
                              class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:outline-none focus:border-[#C2185B]">{{ $contact->address ?? 'Jl. Raya Bandung No. 123, Bandung, Jawa Barat' }}</textarea>
                </div>

                <div class="mb-4">
                    <label class="block text-gray-700 text-sm font-bold mb-2">Maps Embed URL</label>
                    <input type="text" name="maps_embed" value="{{ $contact->maps_embed ?? '' }}" 
                           class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:outline-none focus:border-[#C2185B]">
                    <p class="text-xs text-gray-500 mt-1">URL embed dari Google Maps</p>
                </div>

                <div class="mb-4">
                    <label class="block text-gray-700 text-sm font-bold mb-2">Delivery Info</label>
                    <input type="text" name="delivery_info" value="{{ $contact->delivery_info ?? 'Gratis ongkir area Bandung' }}" 
                           class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:outline-none focus:border-[#C2185B]">
                </div>

                <div class="mb-4">
                    <label class="block text-gray-700 text-sm font-bold mb-2">Parking Info</label>
                    <input type="text" name="parking_info" value="{{ $contact->parking_info ?? 'Parkir luas' }}" 
                           class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:outline-none focus:border-[#C2185B]">
                </div>

                <div class="flex justify-end">
                    <button type="submit" class="px-6 py-2 bg-[#C2185B] text-white rounded-full hover:bg-[#F8BBD9] transition">
                        Update Contact Info
                    </button>
                </div>
            </form>
        </div>

        <!-- Business Hours Management -->
        <div class="bg-white rounded-lg shadow p-6">
            <h2 class="text-xl font-bold text-[#C2185B] mb-4">Business Hours</h2>

            <!-- Add New Hour Form -->
            <form action="{{ route('admin.contact.hours.store') }}" method="POST" class="mb-6 p-4 bg-gray-50 rounded-lg">
                @csrf
                <h3 class="font-semibold mb-3">Add New Hours</h3>
                <div class="grid grid-cols-2 gap-3">
                    <div>
                        <input type="text" name="day" placeholder="Day (e.g. Senin - Jumat)" required 
                               class="w-full px-3 py-2 border border-gray-300 rounded-lg text-sm">
                    </div>
                    <div>
                        <input type="text" name="open_time" placeholder="Open (e.g. 08:00)" required 
                               class="w-full px-3 py-2 border border-gray-300 rounded-lg text-sm">
                    </div>
                    <div>
                        <input type="text" name="close_time" placeholder="Close (e.g. 20:00)" required 
                               class="w-full px-3 py-2 border border-gray-300 rounded-lg text-sm">
                    </div>
                    <div>
                        <input type="number" name="order" placeholder="Order" value="0" 
                               class="w-full px-3 py-2 border border-gray-300 rounded-lg text-sm">
                    </div>
                </div>
                <button type="submit" class="mt-3 px-4 py-2 bg-green-600 text-white rounded-full text-sm hover:bg-green-700 transition">
                    Add Hours
                </button>
            </form>

            <!-- Hours List -->
            <table class="w-full">
                <thead>
                    <tr class="border-b">
                        <th class="text-left py-2">Day</th>
                        <th class="text-left">Open</th>
                        <th class="text-left">Close</th>
                        <th class="text-left">Order</th>
                        <th class="text-left">Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($businessHours as $hour)
                    <tr class="border-b">
                        <td class="py-2">{{ $hour->day }}</td>
                        <td>{{ $hour->open_time }}</td>
                        <td>{{ $hour->close_time }}</td>
                        <td>{{ $hour->order }}</td>
                        <td>
                            <button onclick="editHour({{ $hour->id }}, '{{ $hour->day }}', '{{ $hour->open_time }}', '{{ $hour->close_time }}', {{ $hour->order }})" 
                                    class="text-blue-600 hover:underline mr-2 text-sm">Edit</button>
                            <form action="{{ route('admin.contact.hours.destroy', $hour) }}" method="POST" class="inline">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="text-red-600 hover:underline text-sm" onclick="return confirm('Are you sure?')">Delete</button>
                            </form>
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="5" class="text-center py-4 text-gray-500">No business hours found</td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
</div>

<!-- Edit Hour Modal -->
<div id="editHourModal" class="fixed inset-0 bg-gray-600 bg-opacity-50 hidden items-center justify-center z-50">
    <div class="bg-white rounded-lg p-6 max-w-md w-full">
        <h3 class="text-xl font-bold text-[#C2185B] mb-4">Edit Business Hour</h3>
        <form id="editHourForm" method="POST">
            @csrf
            @method('PUT')
            <div class="mb-4">
                <label class="block text-gray-700 text-sm font-bold mb-2">Day</label>
                <input type="text" name="day" id="edit_day" required 
                       class="w-full px-3 py-2 border border-gray-300 rounded-lg">
            </div>
            <div class="mb-4">
                <label class="block text-gray-700 text-sm font-bold mb-2">Open Time</label>
                <input type="text" name="open_time" id="edit_open" required 
                       class="w-full px-3 py-2 border border-gray-300 rounded-lg">
            </div>
            <div class="mb-4">
                <label class="block text-gray-700 text-sm font-bold mb-2">Close Time</label>
                <input type="text" name="close_time" id="edit_close" required 
                       class="w-full px-3 py-2 border border-gray-300 rounded-lg">
            </div>
            <div class="mb-4">
                <label class="block text-gray-700 text-sm font-bold mb-2">Order</label>
                <input type="number" name="order" id="edit_order" 
                       class="w-full px-3 py-2 border border-gray-300 rounded-lg">
            </div>
            <div class="flex justify-end space-x-3">
                <button type="button" onclick="closeEditModal()" class="px-4 py-2 border border-gray-300 rounded-full hover:bg-gray-100 transition">
                    Cancel
                </button>
                <button type="submit" class="px-4 py-2 bg-[#C2185B] text-white rounded-full hover:bg-[#F8BBD9] transition">
                    Update
                </button>
            </div>
        </form>
    </div>
</div>

<script>
function editHour(id, day, open, close, order) {
    document.getElementById('edit_day').value = day;
    document.getElementById('edit_open').value = open;
    document.getElementById('edit_close').value = close;
    document.getElementById('edit_order').value = order;
    document.getElementById('editHourForm').action = '/admin/contact/hours/' + id;
    document.getElementById('editHourModal').classList.remove('hidden');
    document.getElementById('editHourModal').classList.add('flex');
}

function closeEditModal() {
    document.getElementById('editHourModal').classList.add('hidden');
    document.getElementById('editHourModal').classList.remove('flex');
}
</script>
@endsection