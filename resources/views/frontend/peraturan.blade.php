@extends('layout.user')
@section('title', 'Peraturan')
@section('content')

    <div class="min-h-screen  text-white mt-14 py-4">
        <div class="container mx-auto py-10">
            <!-- Header -->
            <div class="text-center mb-8">
                <h1 class="text-4xl font-bold">Peraturan Turnamen</h1>
                <p class="text-gray-400 mt-2">Panduan dan aturan yang harus diikuti oleh peserta turnamen</p>
            </div>

            <!-- Konten Peraturan -->
            <div class="p-6 bg-gray-800 rounded-lg space-y-6">
                <!-- Pendahuluan -->
                <section>
                    <h2 class="text-2xl font-semibold mb-2">1. Pendahuluan</h2>
                    <p class="text-gray-400 leading-relaxed">
                        Peraturan ini dirancang untuk memastikan kelancaran dan keadilan dalam turnamen. Semua peserta wajib
                        membaca dan memahami peraturan ini sebelum mengikuti turnamen.
                    </p>
                </section>

                <!-- Kualifikasi Peserta -->
                <section>
                    <h2 class="text-2xl font-semibold mb-2">2. Kualifikasi Peserta</h2>
                    <ul class="list-disc pl-6 text-gray-400">
                        <li>Peserta harus terdaftar secara resmi melalui sistem <a href="{{ route('register') }}"
                                class="text-red-600 border-b-1 border-gray-50">pendaftaran</a> kami.</li>
                        <li>Peserta menggunakan akun game sesuai yang didaftarkan melalui sistem <a
                                href="{{ route('register') }}"
                                class="text-red-600 border-b-1 border-gray-50">pendaftaran</a> kami</li>
                    </ul>
                </section>

                <!-- Aturan Permainan -->
                <section>
                    <h2 class="text-2xl font-semibold mb-2">3. Aturan Permainan</h2>
                    <ul class="list-disc pl-6 text-gray-400">
                        <li>Setiap pertandingan akan mengikuti format yang telah ditentukan oleh panitia.</li>
                        <li>Peserta dilarang menggunakan cheat, script ilegal, atau alat bantu lainnya.</li>
                        <li>Peserta dilarang menggunakan chat all dan radio all di dalam game pertandingan.</li>
                        <li>Skin on.</li>
                        <li>Recal-recal diperbolehkan.</li>
                        <li>Emot diperbolehkan.</li>
                        <li>Keputusan wasit bersifat final dan tidak dapat diganggu gugat.</li>
                    </ul>
                </section>


                <!-- Jadwal dan Kehadiran -->
                <section>
                    <h2 class="text-2xl font-semibold mb-2">5. Jadwal dan Kehadiran</h2>
                    <ul class="list-disc pl-6 text-gray-400">
                        <li>Peserta wajib hadir 5 menit sebelum pertandingan dimulai.</li>
                        <li>waktu keterlambatan maksimal 10 menit, lengkap tidak lengkapnya peserta tim pertandingan di
                            mulai.</li>
                        <li>Keterlambatan lebih dari 10 menit akan dianggap sebagai kekalahan dalam match tersebut.</li>
                        <li>Jadwal pertandingan dapat berubah sewaktu-waktu dan akan diinformasikan melalui grup Whatsapp
                            resmi.</li>
                    </ul>
                </section>

                <!-- Pelanggaran dan Diskualifikasi -->
                <section>
                    <h2 class="text-2xl font-semibold mb-2">6. Pelanggaran dan Diskualifikasi</h2>
                    <ul class="list-disc pl-6 text-gray-400">
                        <li>Peserta yang melanggar peraturan akan mendapatkan sanksi berupa peringatan, penalti, atau
                            diskualifikasi.</li>
                        <li>Perilaku tidak sportif, termasuk hinaan atau tindakan tidak menyenangkan terhadap peserta lain,
                            akan menyebabkan diskualifikasi langsung.</li>
                    </ul>
                </section>

                <!-- Kontak Panitia -->
                <section>
                    <h2 class="text-2xl font-semibold mb-2">7. Kontak Panitia</h2>
                    <p class="text-gray-400 leading-relaxed">
                        Jika ada pertanyaan atau klarifikasi terkait peraturan, peserta dapat menghubungi kami melalui
                        instagram di <span class="text-blue-400"><a href="https://www.instagram.com/kabaena_cup"
                                class="text-blue-400">@kabaena_cup</a></span>
                        atau melalui grup resmi.
                    </p>
                </section>
            </div>
        </div>
    </div>
@endsection
