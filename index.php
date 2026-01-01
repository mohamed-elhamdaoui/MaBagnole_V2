<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>MaBagnole | Louez votre liberté</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
    <style>
        .hero-gradient { background: linear-gradient(rgba(0,0,0,0.6), rgba(0,0,0,0.3)), url('https://images.unsplash.com/photo-1492144534655-ae79c964c9d7?auto=format&fit=crop&q=80&w=1920'); }
        .glass { background: rgba(255, 255, 255, 0.95); backdrop-filter: blur(10px); }
    </style>
</head>
<body class="bg-white font-sans text-gray-900">

    <nav class="fixed top-0 w-full z-50 p-6 md:px-16 flex justify-between items-center transition-all duration-300">
        <h1 class="text-3xl font-black text-white italic tracking-tighter drop-shadow-lg">
            Ma<span class="text-red-600">Bagnole</span>
        </h1>
        
        <div class="hidden md:flex space-x-10 text-white font-bold text-xs uppercase tracking-widest drop-shadow-md">
            <a href="index.php" class="text-red-500 border-b-2 border-red-500 pb-1">Accueil</a>
            <a href="catalogue.php" class="hover:text-red-500 transition">Véhicules</a>
            <a href="#about" class="hover:text-red-500 transition">Pourquoi nous ?</a>
        </div>

        <div class="flex items-center space-x-6">
            <a href="auth/login.php" class="text-white text-sm font-bold hover:text-red-500 transition drop-shadow-md">Connexion</a>
            <a href="auth/register.php" class="bg-red-600 text-white px-8 py-3 rounded-full font-black text-sm hover:bg-white hover:text-red-600 transition shadow-2xl">REJOINDRE</a>
        </div>
    </nav>

    <header class="relative h-screen flex items-center justify-center hero-gradient bg-cover bg-center">
        <div class="container mx-auto px-6 text-center relative z-10">
            <h2 class="text-6xl md:text-8xl font-black text-white leading-tight mb-8 tracking-tighter">
                S'ÉVADER SANS <br><span class="text-red-600 italic">LIMITES.</span>
            </h2>
            <p class="text-gray-200 text-lg md:text-xl max-w-2xl mx-auto mb-12 font-medium">
                Découvrez notre parc de véhicules premium au Maroc. Réservez en ligne et récupérez vos clés en 5 minutes.
            </p>

            <form action="catalogue.php" method="GET" class="glass p-2 rounded-[35px] shadow-2xl flex flex-col md:flex-row gap-2 max-w-4xl mx-auto border border-white/30">
                <div class="flex-1 flex items-center px-6 py-4 border-r border-gray-100">
                    <i class="fas fa-search text-red-600 mr-4"></i>
                    <input type="text" name="search" placeholder="Quel modèle ? (ex: Tesla, BMW...)" class="w-full bg-transparent outline-none text-gray-800 font-bold placeholder:text-gray-400">
                </div>
                <div class="flex-1 flex items-center px-6 py-4">
                    <i class="fas fa-list text-red-600 mr-4"></i>
                    <select name="category" class="w-full bg-transparent outline-none text-gray-600 font-bold cursor-pointer">
                        <option value="">Toutes catégories</option>
                        <option value="1">Citadines</option>
                        <option value="2">Luxe & Berlines</option>
                    </select>
                </div>
                <button type="submit" class="bg-red-600 text-white px-12 py-5 rounded-[30px] font-black hover:bg-black transition-all transform hover:scale-105">
                    RECHERCHER
                </button>
            </form>
        </div>
    </header>

    <section class="py-24 bg-white">
        <div class="container mx-auto px-6">
            <div class="text-center mb-16">
                <span class="text-red-600 font-black uppercase tracking-widest text-sm">Nos Univers</span>
                <h3 class="text-4xl font-black mt-2">Explorez par Catégorie</h3>
            </div>

            <div class="grid grid-cols-2 md:grid-cols-4 gap-8">
                <a href="catalogue.php?cat=1" class="group bg-gray-50 p-10 rounded-[40px] text-center hover:bg-red-600 transition-all duration-500">
                    <div class="w-16 h-16 bg-white text-red-600 rounded-3xl flex items-center justify-center mx-auto mb-6 text-2xl shadow-sm group-hover:scale-110 transition">
                        <i class="fas fa-car-side"></i>
                    </div>
                    <h4 class="font-black text-gray-900 group-hover:text-white uppercase tracking-tighter">Citadines</h4>
                </a>
                
                <a href="catalogue.php?cat=2" class="group bg-gray-50 p-10 rounded-[40px] text-center hover:bg-red-600 transition-all duration-500">
                    <div class="w-16 h-16 bg-white text-red-600 rounded-3xl flex items-center justify-center mx-auto mb-6 text-2xl shadow-sm group-hover:scale-110 transition">
                        <i class="fas fa-shuttle-van"></i>
                    </div>
                    <h4 class="font-black text-gray-900 group-hover:text-white uppercase tracking-tighter">SUV & 4x4</h4>
                </a>

                <a href="catalogue.php?cat=3" class="group bg-gray-50 p-10 rounded-[40px] text-center hover:bg-red-600 transition-all duration-500">
                    <div class="w-16 h-16 bg-white text-red-600 rounded-3xl flex items-center justify-center mx-auto mb-6 text-2xl shadow-sm group-hover:scale-110 transition">
                        <i class="fas fa-motorcycle"></i>
                    </div>
                    <h4 class="font-black text-gray-900 group-hover:text-white uppercase tracking-tighter">Motos</h4>
                </a>

                <a href="catalogue.php?cat=4" class="group bg-gray-50 p-10 rounded-[40px] text-center hover:bg-red-600 transition-all duration-500">
                    <div class="w-16 h-16 bg-white text-red-600 rounded-3xl flex items-center justify-center mx-auto mb-6 text-2xl shadow-sm group-hover:scale-110 transition">
                        <i class="fas fa-gem"></i>
                    </div>
                    <h4 class="font-black text-gray-900 group-hover:text-white uppercase tracking-tighter">Luxe</h4>
                </a>
            </div>
        </div>
    </section>

    <section class="py-24 bg-gray-50">
        <div class="container mx-auto px-6">
            <div class="flex flex-col md:flex-row justify-between items-end mb-16 gap-4">
                <div>
                    <span class="text-red-600 font-black uppercase tracking-widest text-sm">Le meilleur du parc</span>
                    <h3 class="text-4xl font-black mt-2">Véhicules en Vedette</h3>
                </div>
                <a href="catalogue.php" class="bg-gray-900 text-white px-8 py-3 rounded-full font-bold text-sm hover:bg-red-600 transition">VOIR TOUT LE CATALOGUE</a>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-3 gap-10">
                <div class="bg-white rounded-[45px] overflow-hidden shadow-sm hover:shadow-2xl transition-all duration-500 group border border-gray-100">
                    <div class="relative overflow-hidden h-64">
                        <img src="https://images.unsplash.com/photo-1555215695-3004980ad54e?auto=format&fit=crop&q=80&w=800" class="w-full h-full object-cover group-hover:scale-110 transition duration-700">
                        <div class="absolute top-6 left-6">
                            <span class="bg-white/90 backdrop-blur px-4 py-2 rounded-2xl text-[10px] font-black uppercase shadow-xl tracking-widest">Berline Luxe</span>
                        </div>
                    </div>
                    <div class="p-10">
                        <div class="flex justify-between items-center mb-6">
                            <h4 class="text-2xl font-black text-gray-900 tracking-tighter uppercase italic">BMW Série 3</h4>
                            <p class="text-2xl font-black text-red-600">85€<span class="text-xs text-gray-400 font-normal">/j</span></p>
                        </div>
                        <div class="flex gap-4 mb-8 text-gray-400 text-xs font-bold uppercase border-b pb-6">
                            <span><i class="fas fa-cog mr-2"></i>Auto</span>
                            <span><i class="fas fa-gas-pump mr-2"></i>Diesel</span>
                            <span><i class="fas fa-user-friends mr-2"></i>5 Places</span>
                        </div>
                        <a href="details.php?id=12" class="block w-full text-center bg-gray-900 text-white py-5 rounded-3xl font-black hover:bg-red-600 transition shadow-xl shadow-gray-100">RÉSERVER MAINTENANT</a>
                    </div>
                </div>
                </div>
        </div>
    </section>

    <footer class="bg-gray-900 text-white pt-24 pb-12 px-6">
        <div class="container mx-auto">
            <div class="grid grid-cols-1 md:grid-cols-4 gap-16 border-b border-gray-800 pb-20">
                <div class="col-span-2">
                    <h2 class="text-4xl font-black italic mb-8">Ma<span class="text-red-600">Bagnole</span></h2>
                    <p class="text-gray-400 max-w-sm leading-relaxed">
                        MaBagnole est la référence premium pour la location de véhicules au Maroc. Profitez d'une flotte neuve et d'un service client disponible 24/7.
                    </p>
                    <div class="flex space-x-6 mt-8">
                        <a href="#" class="text-gray-500 hover:text-red-600 transition text-2xl"><i class="fab fa-instagram"></i></a>
                        <a href="#" class="text-gray-500 hover:text-red-600 transition text-2xl"><i class="fab fa-facebook"></i></a>
                        <a href="#" class="text-gray-500 hover:text-red-600 transition text-2xl"><i class="fab fa-linkedin"></i></a>
                    </div>
                </div>
                <div>
                    <h4 class="text-white font-black uppercase text-xs tracking-widest mb-8">Navigation</h4>
                    <ul class="space-y-4 text-gray-500 text-sm font-bold">
                        <li><a href="catalogue.php" class="hover:text-red-600 transition">Notre Catalogue</a></li>
                        <li><a href="auth/login.php" class="hover:text-red-600 transition">Espace Client</a></li>
                        <li><a href="admin/index.php" class="hover:text-red-600 transition">Administration</a></li>
                    </ul>
                </div>
                <div>
                    <h4 class="text-white font-black uppercase text-xs tracking-widest mb-8">Contact</h4>
                    <p class="text-gray-500 text-sm mb-2">📍 Casablanca, Maroc</p>
                    <p class="text-gray-500 text-sm mb-2">📞 +212 522 123 456</p>
                    <p class="text-gray-500 text-sm">✉️ contact@mabagnole.ma</p>
                </div>
            </div>
            <p class="text-center text-gray-600 text-[10px] font-bold uppercase tracking-[0.2em] mt-12 italic">
                © 2026 MaBagnole Corporation - Tous droits réservés.
            </p>
        </div>
    </footer>

    <script>
        window.onscroll = function() {
            const nav = document.querySelector('nav');
            if (window.scrollY > 50) {
                nav.classList.add('bg-white/95', 'shadow-xl', 'py-4');
                nav.classList.remove('bg-black/20', 'py-6');
                document.querySelectorAll('nav a').forEach(a => {
                    if(!a.classList.contains('bg-red-600')) a.classList.replace('text-white', 'text-gray-900');
                });
                document.querySelector('nav h1').classList.replace('text-white', 'text-gray-900');
            } else {
                nav.classList.remove('bg-white/95', 'shadow-xl', 'py-4');
                nav.classList.add('bg-black/20', 'py-6');
                document.querySelectorAll('nav a').forEach(a => {
                    if(!a.classList.contains('bg-red-600')) a.classList.replace('text-gray-900', 'text-white');
                });
                document.querySelector('nav h1').classList.replace('text-gray-900', 'text-white');
            }
        };
    </script>
</body>
</html>