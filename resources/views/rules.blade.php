<x-guest-layout>
    <div class="max-w-4xl mx-auto px-6">
        <header class="text-center mb-16">
            <h1 class="text-5xl md:text-6xl font-bold text-ink italic leading-tight">Rules</h1>
            <div class="flex justify-center items-center gap-4 mt-6">
                <div class="h-[1px] w-12 bg-sepia-edge"></div>
                <span class="text-coffee uppercase tracking-[0.3em] text-xs font-bold">Sebuah Narasi Singkat</span>
                <div class="h-[1px] w-12 bg-sepia-edge"></div>
            </div>
        </header>

        <section class="prose prose-stone lg:prose-xl mx-auto italic text-coffee leading-relaxed mb-20">
            <p class="mb-8">
                <span
                    class="float-left text-7xl font-bold text-ink mr-3 mt-2 leading-none border-b-4 border-coffee">1</span>
                Lorem ipsum dolor sit amet consectetur adipisicing elit. Adipisci, doloribus. Ipsa iure architecto voluptatem alias ratione voluptatum eligendi deleniti iusto repellat eveniet dolore a provident error, aut maiores ea aliquam quia dolores. Libero sint quibusdam aut neque delectus, animi architecto ipsa quidem similique incidunt sed corrupti distinctio soluta adipisci qui aperiam quas ullam, tempore quos! Cupiditate laboriosam consequatur eligendi dolorem earum expedita laudantium, maiores, aliquam, inventore voluptas assumenda! Mollitia distinctio quidem deleniti fugiat sequi accusantium optio inventore at.
            </p>
            <p class="mb-8">
                <span
                    class="float-left text-7xl font-bold text-ink mr-3 mt-2 leading-none border-b-4 border-coffee">2</span>
                Lorem ipsum dolor sit amet consectetur adipisicing elit. Inventore provident mollitia odit minima unde perferendis molestias, voluptate alias ipsa, doloremque placeat totam nam ea dolorum adipisci labore libero! Perferendis sapiente aliquid, ea aspernatur quam magnam soluta ipsum maiores iste architecto, quos hic voluptatum veniam suscipit et ex voluptates officia repellat inventore reprehenderit nulla asperiores excepturi accusantium! Fugit, amet officiis. Asperiores voluptatum exercitationem quo expedita delectus ullam dolores illo eligendi numquam repudiandae. Omnis modi dolorem voluptas illo cumque veritatis odio delectus quo eaque id nesciunt corrupti quas repellat recusandae eum atque, tenetur maiores quae! Facere libero maiores dolores fugit amet dolorum veritatis atque asperiores sapiente reprehenderit fuga, voluptates dolorem doloremque nam rerum, tempore est vel obcaecati consequatur molestiae beatae. Sint exercitationem tempora, non laboriosam dolorem aut repudiandae temporibus, illo accusantium quasi officia molestias.
            </p>
            <p class="mb-8">
                <span
                    class="float-left text-7xl font-bold text-ink mr-3 mt-2 leading-none border-b-4 border-coffee">3</span>
                Lorem ipsum dolor sit amet consectetur adipisicing elit. Accusamus architecto veritatis maiores vitae provident quibusdam, iure rerum reprehenderit laudantium nulla, soluta cupiditate, molestias excepturi esse? Maiores illo perferendis voluptatem voluptatum adipisci nam accusamus, praesentium reiciendis quos nemo a. Dolores quisquam ducimus, ullam nemo saepe hic dolorum beatae reiciendis eum sed perferendis enim, molestias atque voluptatem autem ipsa! Ducimus sit possimus iure, voluptas nostrum voluptatem voluptate porro veritatis asperiores rerum odit similique? Facere esse ut ea maiores blanditiis, veniam dolore delectus voluptates temporibus cupiditate, nulla at praesentium. Possimus quibusdam fuga neque corrupti, esse porro dicta, rerum, consequuntur nisi ipsum tempore. Rem quos fuga atque minus odit numquam, possimus, doloribus accusantium sit iure ratione, alias illum nam aliquam perferendis dolor accusamus sed facere beatae sint! Vero voluptate nostrum illum cupiditate enim quidem, ipsum est rem quasi beatae reiciendis nisi iste unde ducimus. Praesentium omnis minus veniam recusandae fugit libero sed possimus quam, sunt necessitatibus, eos velit? Praesentium aliquam iure obcaecati.
            </p>
        </section>

        <div class="grid grid-cols-1 md:grid-cols-2 gap-8 mb-20">
            <div
                class="p-8 bg-parchment-base border border-sepia-edge/30 rounded-sm shadow-inner relative overflow-hidden group">
                <div
                    class="absolute -top-4 -right-4 text-8xl text-sepia-edge/10 font-bold group-hover:scale-110 transition-transform">
                    01</div>
                <h3 class="text-xl font-bold text-ink mb-4 italic">Preservasi Pengetahuan</h3>
                <p class="text-sm text-coffee leading-loose">Kami memastikan setiap data buku tersimpan dengan standar
                    arsip yang baik, menjaga detail penulis hingga nomor ISBN sebagai identitas abadi.</p>
            </div>

            <div
                class="p-8 bg-parchment-base border border-sepia-edge/30 rounded-sm shadow-inner relative overflow-hidden group">
                <div
                    class="absolute -top-4 -right-4 text-8xl text-sepia-edge/10 font-bold group-hover:scale-110 transition-transform">
                    02</div>
                <h3 class="text-xl font-bold text-ink mb-4 italic">Aksesibilitas Estetik</h3>
                <p class="text-sm text-coffee leading-loose">Membaca secara digital tidak harus membosankan. Kami
                    mendesain antarmuka yang tenang agar fokus Anda tetap pada buku yang Anda cari.</p>
            </div>
        </div>

        <section class="text-center py-16 border-t border-b border-sepia-edge/20 italic">
            <p class="text-2xl text-ink mb-8">"Buku adalah cermin jiwa; Anda hanya melihat di dalamnya apa yang sudah
                Anda miliki di dalam diri Anda."</p>
            <div class="flex justify-center gap-6">
                <x-ui.button variant="primary" href="{{ route('register') }}" wire:navigate>
                    Bergabung Menjadi Anggota
                </x-ui.button>
            </div>
        </section>
    </div>
</x-guest-layout>