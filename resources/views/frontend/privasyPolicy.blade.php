@extends('layout.user')
@section('title', 'Privasy Policy')
@section('content')


    <div class="min-h-screen bg-gray-900 text-white mt-14 py-4">
        <div class="container mx-auto py-10">
            <!-- Header -->
            <div class="text-center mb-8">
                <h1 class="text-4xl font-bold">Privacy Policy</h1>
                <p class="text-gray-400 mt-2">Kebijakan Privasi untuk Turnamen Kami</p>
            </div>

            <!-- Konten Kebijakan Privasi -->
            <div class="p-6 bg-gray-800 rounded-lg space-y-6">
                <!-- Pendahuluan -->
                <section>
                    <h2 class="text-2xl font-semibold mb-2">1. Pendahuluan</h2>
                    <p class="text-gray-400 leading-relaxed">
                        Kami menghargai privasi Anda dan berkomitmen untuk melindungi data pribadi Anda. Kebijakan privasi
                        ini menjelaskan bagaimana kami mengumpulkan, menggunakan, dan melindungi informasi Anda saat Anda
                        mendaftar dan berpartisipasi dalam turnamen yang kami selenggarakan. Dengan mendaftar ke turnamen
                        kami, Anda menyetujui kebijakan privasi ini.
                    </p>
                </section>

                <!-- Informasi yang Dikumpulkan -->
                <section>
                    <h2 class="text-2xl font-semibold mb-2">2. Informasi yang Kami Kumpulkan</h2>
                    <p class="text-gray-400 leading-relaxed">
                        Kami dapat mengumpulkan informasi berikut dari peserta:
                    </p>
                    <ul class="list-disc pl-6 text-gray-400">
                        <li>Nama lengkap</li>
                        <li>Nomor telepon</li>
                        <li>Informasi tim atau organisasi</li>
                        <li>Data lainnya yang relevan dengan turnamen</li>
                    </ul>
                </section>

                <!-- Penggunaan Informasi -->
                <section>
                    <h2 class="text-2xl font-semibold mb-2">3. Penggunaan Informasi</h2>
                    <p class="text-gray-400 leading-relaxed">
                        Informasi yang kami kumpulkan digunakan untuk:
                    </p>
                    <ul class="list-disc pl-6 text-gray-400">
                        <li>Mengelola pendaftaran dan partisipasi Anda</li>
                        <li>Berkomunikasi terkait jadwal, pengumuman, dan informasi lainnya</li>
                        <li>Memastikan kelancaran jalannya turnamen</li>
                        <li>Menyediakan hadiah bagi pemenang</li>
                    </ul>
                </section>

                <!-- Perlindungan Data -->
                <section>
                    <h2 class="text-2xl font-semibold mb-2">4. Perlindungan Data</h2>
                    <p class="text-gray-400 leading-relaxed">
                        Kami menerapkan langkah-langkah teknis dan organisasi yang wajar untuk melindungi data pribadi Anda
                        dari akses, penggunaan, atau pengungkapan yang tidak sah.
                    </p>
                </section>

                <!-- Hak Anda -->
                <section>
                    <h2 class="text-2xl font-semibold mb-2">5. Hak Anda</h2>
                    <p class="text-gray-400 leading-relaxed">
                        Anda memiliki memperbaiki, atau meminta penghapusan data pribadi Anda. Untuk
                        melakukannya, silakan hubungi kami melalui informasi kontak yang disediakan.
                    </p>
                </section>

                <!-- Perubahan Kebijakan -->
                <section>
                    <h2 class="text-2xl font-semibold mb-2">6. Perubahan Kebijakan</h2>
                    <p class="text-gray-400 leading-relaxed">
                        Kami dapat memperbarui kebijakan privasi ini dari waktu ke waktu. Perubahan akan diumumkan melalui
                        situs web kami.
                    </p>
                </section>
            </div>
        </div>
    </div>


@endsection
