<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Catalogue - MaBagnole</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
</head>
<body class="bg-gray-50 font-sans text-gray-900">

    <?php include 'includes/navbar.php'; ?>

    <div class="pt-32 pb-12 bg-gray-900 px-6 md:px-16">
        <div class="container mx-auto">
            <h1 class="text-4xl md:text-5xl font-black text-white italic tracking-tighter">
                NOTRE <span class="text-red-600">FLOTTE.</span>
            </h1>
            <p class="text-gray-400 mt-2">Explorez nos véhicules disponibles pour votre prochain trajet.</p>
        </div>
    </div>

    <main class="container mx-auto px-6 md:px-16 py-12">
        <div class="flex flex-col lg:flex-row gap-12">
            
            <aside class="w-full lg:w-1/4">
                <div class="bg-white p-8 rounded-[40px] shadow-sm border border-gray-100 sticky top-28">
                    <h3 class="text-xl font-black mb-8 flex items-center">
                        <i class="fas fa-sliders-h mr-3 text-red-600"></i> FILTRES
                    </h3>

                    <form id="filter-form" action="catalogue.php" method="GET" class="space-y-8">
                        <div>
                            <label class="block text-[10px] font-black text-gray-400 uppercase mb-3 tracking-widest">Recherche</label>
                            <div class="relative">
                                <input type="text" name="search" placeholder="Modèle..." 
                                       class="w-full p-4 bg-gray-50 border-none rounded-2xl focus:ring-2 focus:ring-red-500 outline-none text-sm font-bold">
                                <i class="fas fa-search absolute right-4 top-4 text-gray-300"></i>
                            </div>
                        </div>

                        <div>
                            <label class="block text-[10px] font-black text-gray-400 uppercase mb-4 tracking-widest">Catégories</label>
                            <div class="space-y-3">
                                <label class="flex items-center group cursor-pointer">
                                    <input type="checkbox" name="cat[]" value="1" class="hidden peer">
                                    <div class="w-5 h-5 border-2 border-gray-200 rounded-lg mr-3 peer-checked:bg-red-600 peer-checked:border-red-600 transition flex items-center justify-center">
                                        <i class="fas fa-check text-[10px] text-white"></i>
                                    </div>
                                    <span class="text-sm font-bold text-gray-500 group-hover:text-red-600 transition">Citadines</span>
                                </label>
                                <label class="flex items-center group cursor-pointer">
                                    <input type="checkbox" name="cat[]" value="2" class="hidden peer">
                                    <div class="w-5 h-5 border-2 border-gray-200 rounded-lg mr-3 peer-checked:bg-red-600 peer-checked:border-red-600 transition flex items-center justify-center">
                                        <i class="fas fa-check text-[10px] text-white"></i>
                                    </div>
                                    <span class="text-sm font-bold text-gray-500 group-hover:text-red-600 transition">SUV & 4x4</span>
                                </label>
                                <label class="flex items-center group cursor-pointer">
                                    <input type="checkbox" name="cat[]" value="3" class="hidden peer">
                                    <div class="w-5 h-5 border-2 border-gray-200 rounded-lg mr-3 peer-checked:bg-red-600 peer-checked:border-red-600 transition flex items-center justify-center">
                                        <i class="fas fa-check text-[10px] text-white"></i>
                                    </div>
                                    <span class="text-sm font-bold text-gray-500 group-hover:text-red-600 transition">Motos</span>
                                </label>
                            </div>
                        </div>

                        <div>
                            <label class="block text-[10px] font-black text-gray-400 uppercase mb-4 tracking-widest">Budget Max / Jour</label>
                            <input type="range" name="price_max" min="20" max="500" value="500" 
                                   class="w-full h-2 bg-gray-100 rounded-lg appearance-none cursor-pointer accent-red-600">
                            <div class="flex justify-between mt-2 text-[10px] font-black text-gray-400">
                                <span>20€</span>
                                <span id="price-display" class="text-red-600">500€</span>
                            </div>
                        </div>

                        <button type="submit" class="w-full bg-gray-900 text-white py-4 rounded-2xl font-black hover:bg-red-600 transition-all shadow-xl shadow-gray-100 uppercase text-xs tracking-widest">
                            Appliquer
                        </button>
                    </form>
                </div>
            </aside>

            <div class="flex-1">
                <div class="flex flex-col md:flex-row justify-between items-center mb-10 gap-4">
                    <p class="text-sm font-bold text-gray-400 italic">Affichage de <span class="text-gray-900">12 véhicules</span> correspondants</p>
                    <select class="bg-white border border-gray-100 rounded-xl px-4 py-2 text-xs font-bold outline-none focus:ring-2 focus:ring-red-500">
                        <option>Trier par : Recommandé</option>
                        <option>Prix : Croissant</option>
                        <option>Prix : Décroissant</option>
                    </select>
                </div>

                <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
                    
                    <div class="bg-white rounded-[45px] overflow-hidden shadow-sm hover:shadow-2xl transition-all duration-500 group border border-gray-100">
                        <div class="relative overflow-hidden h-52">
                            <img src="https://images.unsplash.com/photo-1542362567-b05261b2024c?auto=format&fit=crop&q=80&w=600" class="w-full h-full object-cover group-hover:scale-110 transition duration-700">
                            <div class="absolute top-4 right-4 bg-white/95 backdrop-blur px-3 py-1 rounded-xl text-[9px] font-black uppercase tracking-tighter shadow-sm">
                                Disponible
                            </div>
                        </div>
                        <div class="p-8">
                            <div class="flex justify-between items-start mb-4">
                                <div>
                                    <h4 class="text-lg font-black text-gray-900 tracking-tighter uppercase italic">Audi R8 Spyder</h4>
                                    <p class="text-[10px] text-red-600 font-bold uppercase tracking-widest">Luxe / Sport</p>
                                </div>
                                <p class="text-xl font-black text-gray-900">120€<span class="text-[10px] text-gray-400 font-normal">/j</span></p>
                            </div>
                            <div class="flex justify-between items-center text-gray-400 text-[10px] font-bold uppercase mb-8 pb-4 border-b">
                                <span><i class="fas fa-cog mr-1"></i>Auto</span>
                                <span><i class="fas fa-gas-pump mr-1"></i>Essence</span>
                                <span><i class="fas fa-user mr-1"></i>2 Pl.</span>
                            </div>
                            <a href="details.php?id=1" class="block w-full text-center bg-gray-50 text-gray-900 py-4 rounded-2xl font-black hover:bg-red-600 hover:text-white transition-all shadow-sm">
                                RÉSERVER
                            </a>
                        </div>
                    </div>
                    </div>

                <div class="mt-16 flex justify-center items-center gap-3">
                    <button class="w-12 h-12 bg-white border border-gray-100 rounded-2xl flex items-center justify-center text-gray-400 hover:text-red-600 transition"><i class="fas fa-chevron-left"></i></button>
                    <button class="w-12 h-12 bg-red-600 text-white rounded-2xl flex items-center justify-center font-black shadow-lg shadow-red-100">1</button>
                    <button class="w-12 h-12 bg-white border border-gray-100 rounded-2xl flex items-center justify-center text-gray-600 font-black hover:bg-gray-100 transition">2</button>
                    <button class="w-12 h-12 bg-white border border-gray-100 rounded-2xl flex items-center justify-center text-gray-400 hover:text-red-600 transition"><i class="fas fa-chevron-right"></i></button>
                </div>
            </div>
        </div>
    </main>

    <script>
        const slider = document.querySelector('input[name="price_max"]');
        const display = document.getElementById('price-display');
        slider.oninput = function() {
            display.innerHTML = this.value + "€";
        }
    </script>

</body>
</html>