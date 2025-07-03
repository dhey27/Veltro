@extends('layouts.app')

@section('content')
    <div class="container">
        <h1 class="mb-4">Hubungi Kami</h1>

        <div class="row">
            {{-- Informasi Kontak --}}
            <div class="col-md-6">
                <h5 class="mb-3">Informasi Kontak</h5>
                <ul class="list-unstyled">
                    <li><strong>Alamat:</strong> Jl. Raya Soekarno-Hatta No.315 Bandung</li>
                    <li><strong>Email:</strong> admin@veltrosneakers.com</li>
                    <li><strong>Telepon:</strong> 0812-1429-7520</li>
                    <li><strong>Jam Operasional:</strong> 08.00 - 17.00 WIB (Senin - Kiamat)</li>
                </ul>
            </div>

            {{-- Google Maps --}}
            <div class="col-md-6">
                <h5 class="mb-3">Lokasi Toko</h5>
                <iframe
                    src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3960.525623291948!2d107.59295837122833!3d-6.94715229305301!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x2e68e8bfae6da1c1%3A0x7b1caadcb5428f12!2sJl.%20Soekarno-Hatta%20No.315%2C%20Kb.%20Lega%2C%20Kec.%20Bojongloa%20Kidul%2C%20Kota%20Bandung%2C%20Jawa%20Barat%2040235!5e0!3m2!1sid!2sid!4v1750707900094!5m2!1sid!2sid"
                    width="100%" height="250" style="border:0;" allowfullscreen="" loading="lazy"
                    referrerpolicy="no-referrer-when-downgrade">

                </iframe>
            </div>
        </div>

        {{-- Sosial Media --}}
        <div class="row mt-5">
            <div class="col text-center">
                <h5>Ikuti Kami di Media Sosial</h5>
                <a href="https://instagram.com/veltro.official" class="btn btn-outline-dark btn-sm mx-2" target="_blank">
                    <i class="bi bi-instagram"></i> Instagram
                </a>
                <a href="https://facebook.com/veltro.official" class="btn btn-outline-dark btn-sm mx-2" target="_blank">
                    <i class="bi bi-facebook"></i> Facebook
                </a>
                <a href="https://wa.me/6281214297520?text=Halo%20saya%20ingin%20bertanya "
                    class="btn btn-outline-success btn-sm mx-2" target="_blank">
                    <i class="bi bi-whatsapp"></i> WhatsApp
                </a>
            </div>
        </div>
    </div>
@endsection