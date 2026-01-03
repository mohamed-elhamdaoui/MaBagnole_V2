<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Véhicules - Admin MaBagnole</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
    <style>
        .modal-animate {
            animation: fadeIn 0.3s ease-out;
        }

        @keyframes fadeIn {
            from {
                opacity: 0;
                transform: scale(0.95);
            }

            to {
                opacity: 1;
                transform: scale(1);
            }
        }
    </style>
</head>

<body class="bg-gray-50 font-sans">

    <div class="flex min-h-screen">

        <aside class="w-72 bg-white border-r border-gray-200 flex-shrink-0 hidden md:flex flex-col">
            <div class="p-8 text-center border-b border-gray-50">
                <div class="w-20 h-20 bg-gray-900 text-white rounded-3xl flex items-center justify-center mx-auto mb-4 text-2xl font-black shadow-xl shadow-gray-200 rotate-3">
                    A
                </div>
                <h2 class="font-bold text-gray-900 text-lg italic">Ma<span class="text-red-600">Bagnole</span></h2>
                <span class="text-[10px] bg-red-100 px-3 py-1 rounded-full uppercase font-black text-red-600 mt-2 inline-block">Administrateur</span>
            </div>

            <nav class="flex-1 p-6 space-y-2">
                <a href="index.php" class="flex items-center p-4 text-gray-500 hover:bg-gray-50 rounded-2xl transition font-bold">
                    <i class="fas fa-chart-line mr-4"></i> Dashboard
                </a>
                <a href="vehicules.php" class="flex items-center p-4 text-red-600 bg-red-50 rounded-2xl font-black border-l-4 border-red-600 transition">
                    <i class="fas fa-car mr-4"></i> Véhicules
                </a>
                <a href="categories.php" class="flex items-center p-4 text-gray-500 hover:bg-gray-50 rounded-2xl transition font-bold">
                    <i class="fas fa-tags mr-4"></i> Catégories
                </a>
                <a href="reservations.php" class="flex items-center p-4 text-gray-500 hover:bg-gray-50 rounded-2xl transition font-bold">
                    <i class="fas fa-calendar-check mr-4"></i> Réservations
                </a>
                <a href="avis.php" class="flex items-center p-4 text-gray-500 hover:bg-gray-50 rounded-2xl transition font-bold">
                    <i class="fas fa-star mr-4"></i> Avis Clients
                </a>
            </nav>

            <div class="p-6 border-t border-gray-100">
                <a href="../auth/logout.php" class="flex items-center p-4 text-gray-400 hover:text-red-600 transition font-semibold">
                    <i class="fas fa-power-off mr-4"></i> Déconnexion
                </a>
            </div>
        </aside>

        <main class="flex-1 p-6 md:p-12">

            <div class="flex flex-col md:flex-row justify-between items-start md:items-center mb-12 gap-4">
                <div>
                    <h1 class="text-4xl font-black text-gray-900">Gestion <span class="text-red-600 italic">Véhicules.</span></h1>
                    <p class="text-gray-400">Contrôlez l'état et la disponibilité de votre parc.</p>
                </div>
                <div class="flex gap-3">
                    <button onclick="toggleModal('bulkVehiculeModal')" class="bg-gray-900 text-white px-6 py-4 rounded-2xl font-bold shadow-xl shadow-gray-200 hover:bg-black transition-all">
                        Insertion Masse
                    </button>
                    <button onclick="toggleModal('addVehiculeModal')" class="bg-red-600 text-white px-6 py-4 rounded-2xl font-bold shadow-xl shadow-red-100 hover:bg-red-700 transition-all">
                        Ajouter Nouveau
                    </button>
                </div>
            </div>

            <div class="grid grid-cols-1 gap-6">

                <div class="bg-white p-6 rounded-[35px] shadow-sm border border-gray-100 flex flex-col md:flex-row items-center gap-8 group hover:border-red-200 transition-all duration-300">
                    <div class="w-full md:w-56 h-32 bg-gray-100 rounded-[25px] overflow-hidden">
                        <img src="https://images.unsplash.com/photo-1555215695-3004980ad54e?auto=format&fit=crop&q=80&w=400" class="w-full h-full object-cover group-hover:scale-110 transition duration-500">
                    </div>

                    <div class="flex-1 grid grid-cols-2 md:grid-cols-4 gap-4 w-full">
                        <div>
                            <p class="text-[10px] font-black text-gray-300 uppercase tracking-widest">Modèle / ID</p>
                            <h4 class="font-bold text-gray-800 tracking-tight">BMW Série 3 <span class="text-gray-300 font-light ml-1">#12</span></h4>
                        </div>
                        <div>
                            <p class="text-[10px] font-black text-gray-300 uppercase tracking-widest">Prix Journalier</p>
                            <p class="font-black text-red-600 text-lg">85.00 €</p>
                        </div>
                        <div>
                            <p class="text-[10px] font-black text-gray-300 uppercase tracking-widest">Catégorie</p>
                            <span class="px-3 py-1 bg-gray-50 text-gray-600 text-[10px] rounded-lg font-bold uppercase">Berline Luxe</span>
                        </div>
                        <div class="flex flex-col items-end justify-center">
                            <span class="px-4 py-1 bg-green-100 text-green-700 text-[9px] rounded-full font-black uppercase">Disponible</span>
                        </div>
                    </div>

                    <div class="flex gap-2">
                        <button class="w-12 h-12 bg-gray-50 text-blue-500 rounded-2xl hover:bg-blue-600 hover:text-white transition shadow-sm"><i class="fas fa-edit"></i></button>
                        <button class="w-12 h-12 bg-gray-50 text-red-400 rounded-2xl hover:bg-red-600 hover:text-white transition shadow-sm"><i class="fas fa-trash-alt"></i></button>
                    </div>
                </div>
            </div>
        </main>
    </div>

    <div id="addVehiculeModal" class="hidden fixed inset-0 bg-black/60 backdrop-blur-sm flex items-center justify-center z-50 p-4">
        <div class="bg-white rounded-[40px] p-10 max-w-3xl w-full shadow-2xl modal-animate overflow-y-auto max-h-[90vh]">
            <div class="flex justify-between items-center mb-8">
                <h2 class="text-3xl font-black text-gray-900">Nouveau <span class="text-red-600 italic">Véhicule.</span></h2>
                <button onclick="toggleModal('addVehiculeModal')" class="text-gray-400 hover:text-gray-600"><i class="fas fa-times text-xl"></i></button>
            </div>

            <form action="../actions/add_vehicule.php" method="POST" class="space-y-6">
                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    <div>
                        <label class="block text-[10px] font-black text-gray-400 uppercase mb-2 tracking-widest">Marque</label>
                        <input type="text" name="marque" required placeholder="Ex: BMW, Audi..."
                            class="w-full p-4 bg-gray-50 border-none rounded-2xl focus:ring-2 focus:ring-red-500 outline-none font-bold text-gray-700">
                    </div>
                    <div>
                        <label class="block text-[10px] font-black text-gray-400 uppercase mb-2 tracking-widest">Modèle</label>
                        <input type="text" name="modele" required placeholder="Ex: Série 3, A4..."
                            class="w-full p-4 bg-gray-50 border-none rounded-2xl focus:ring-2 focus:ring-red-500 outline-none font-bold text-gray-700">
                    </div>
                </div>

                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    <div>
                        <label class="block text-[10px] font-black text-gray-400 uppercase mb-2 tracking-widest">Prix Journalier (€)</label>
                        <input type="number" step="0.01" name="prix_journalier" required placeholder="Ex: 85.00"
                            class="w-full p-4 bg-gray-50 border-none rounded-2xl focus:ring-2 focus:ring-red-500 outline-none font-bold text-gray-700">
                    </div>
                    <div>
                        <label class="block text-[10px] font-black text-gray-400 uppercase mb-2 tracking-widest">Catégorie</label>
                        <select name="categorie_id" required class="w-full p-4 bg-gray-50 border-none rounded-2xl focus:ring-2 focus:ring-red-500 outline-none font-bold text-gray-500 cursor-pointer">
                            <option value="">Sélectionner</option>
                            <option value="1">Citadine</option>
                            <option value="2">SUV & 4x4</option>
                            <option value="3">Motos</option>
                            <option value="4">Luxe</option>
                        </select>
                    </div>
                </div>

                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    <div>
                        <label class="block text-[10px] font-black text-gray-400 uppercase mb-2 tracking-widest">Boîte de vitesse</label>
                        <select name="boite_vitesse" required class="w-full p-4 bg-gray-50 border-none rounded-2xl focus:ring-2 focus:ring-red-500 outline-none font-bold text-gray-500 cursor-pointer">
                            <option value="Automatique">Automatique</option>
                            <option value="Manuelle">Manuelle</option>
                        </select>
                    </div>
                    <div>
                        <label class="block text-[10px] font-black text-gray-400 uppercase mb-2 tracking-widest">Carburant</label>
                        <select name="carburant" required class="w-full p-4 bg-gray-50 border-none rounded-2xl focus:ring-2 focus:ring-red-500 outline-none font-bold text-gray-500 cursor-pointer">
                            <option value="Diesel">Diesel</option>
                            <option value="Essence">Essence</option>
                            <option value="Électrique">Électrique</option>
                            <option value="Hybride">Hybride</option>
                        </select>
                    </div>
                </div>

                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    <div>
                        <label class="block text-[10px] font-black text-gray-400 uppercase mb-2 tracking-widest">Nombre de places</label>
                        <input type="number" name="nb_places" required placeholder="Ex: 5"
                            class="w-full p-4 bg-gray-50 border-none rounded-2xl focus:ring-2 focus:ring-red-500 outline-none font-bold text-gray-700">
                    </div>
                    <div>
                        <label class="block text-[10px] font-black text-gray-400 uppercase mb-2 tracking-widest">URL de l'image</label>
                        <input type="text" name="image_url" placeholder="Lien vers l'image (Unsplash...)"
                            class="w-full p-4 bg-gray-50 border-none rounded-2xl focus:ring-2 focus:ring-red-500 outline-none text-sm text-gray-500">
                    </div>
                </div>

                <div class="flex justify-end gap-4 pt-6 border-t border-gray-50">
                    <button type="button" onclick="toggleModal('addVehiculeModal')" class="font-bold text-gray-400 px-4">Annuler</button>
                    <button type="submit" class="bg-red-600 text-white px-10 py-4 rounded-2xl font-black shadow-lg shadow-red-100 hover:bg-black transition-all">
                        Enregistrer le véhicule
                    </button>
                </div>
            </form>
        </div>
    </div>

    <div id="bulkVehiculeModal" class="hidden fixed inset-0 bg-black/60 backdrop-blur-sm flex items-center justify-center z-50 p-4">
        <div class="bg-white rounded-[40px] p-10 max-w-lg w-full shadow-2xl modal-animate">
            <h2 class="text-3xl font-black text-gray-900 mb-4">Import <span class="text-red-600 italic">Masse.</span></h2>
            <p class="text-sm text-gray-400 mb-6">Ajoutez plusieurs véhicules d'un coup. Séparez les modèles par une virgule.</p>

            <form action="../actions/bulk_vehicule.php" method="POST">
                <textarea name="bulk_data" rows="5" placeholder="BMW X5, Peugeot 3008, Renault Clio..."
                    class="w-full p-6 bg-gray-50 border-none rounded-3xl focus:ring-2 focus:ring-red-500 outline-none font-mono text-sm mb-6"></textarea>

                <div class="flex justify-end gap-4">
                    <button type="button" onclick="toggleModal('bulkVehiculeModal')" class="font-bold text-gray-400 px-4">Fermer</button>
                    <button type="submit" class="bg-gray-900 text-white px-10 py-4 rounded-2xl font-black hover:bg-red-600 transition-all">
                        Lancer l'import
                    </button>
                </div>
            </form>
        </div>
    </div>

    <script>
        function toggleModal(modalId) {
            const modal = document.getElementById(modalId);
            modal.classList.toggle('hidden');
        }

        // Fermeture au clic extérieur
        window.onclick = function(event) {
            if (event.target.classList.contains('bg-black/60')) {
                event.target.classList.add('hidden');
            }
        }
    </script>

</body>

</html>