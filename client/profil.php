<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Mon Profil - MaBagnole</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
</head>
<body class="bg-gray-50">

    <div class="flex min-h-screen">
        <aside class="w-72 bg-white border-r border-gray-200 hidden md:flex flex-col">
            <div class="p-8 text-center">
                <div class="w-20 h-20 bg-gray-900 text-white rounded-full flex items-center justify-center mx-auto mb-4 text-2xl font-bold">A</div>
                <h2 class="font-bold text-gray-800">Ahmed Alami</h2>
            </div>
            <nav class="px-6 space-y-2">
                <a href="dashboard.php" class="flex items-center p-3 text-gray-500 hover:bg-gray-50 rounded-xl transition"><i class="fas fa-key mr-3"></i> Mes Locations</a>
                <a href="avis.php" class="flex items-center p-3 text-gray-500 hover:bg-gray-50 rounded-xl transition"><i class="fas fa-star mr-3"></i> Mes Avis</a>
                <a href="profil.php" class="flex items-center p-3 text-red-600 bg-red-50 rounded-xl font-bold"><i class="fas fa-user-cog mr-3"></i> Mon Profil</a>
            </nav>
        </aside>

        <main class="flex-1 p-8">
            <div class="max-w-3xl mx-auto">
                <h1 class="text-3xl font-black text-gray-900 mb-8">Paramètres du <span class="text-red-600">Compte</span></h1>

                <div class="bg-white rounded-3xl shadow-sm border border-gray-100 overflow-hidden mb-8">
                    <div class="p-6 border-b border-gray-50 bg-gray-50/50">
                        <h3 class="font-bold text-gray-800">Informations Personnelles</h3>
                    </div>
                    <form action="../actions/update_profile.php" method="POST" class="p-8 space-y-6">
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                            <div>
                                <label class="block text-xs font-bold text-gray-400 uppercase mb-2">Nom Complet</label>
                                <input type="text" name="nom" value="Ahmed Alami" class="w-full p-4 bg-gray-50 border-gray-200 rounded-2xl outline-none focus:ring-2 focus:ring-red-500 transition-all">
                            </div>
                            <div>
                                <label class="block text-xs font-bold text-gray-400 uppercase mb-2">Adresse Email</label>
                                <input type="email" name="email" value="ahmed@email.com" class="w-full p-4 bg-gray-50 border-gray-200 rounded-2xl outline-none focus:ring-2 focus:ring-red-500 transition-all">
                            </div>
                        </div>
                        <button type="submit" class="bg-gray-900 text-white px-8 py-3 rounded-xl font-bold hover:bg-red-600 transition shadow-lg">Sauvegarder les modifications</button>
                    </form>
                </div>

                <div class="bg-white rounded-3xl shadow-sm border border-gray-100 overflow-hidden">
                    <div class="p-6 border-b border-gray-50 bg-gray-50/50">
                        <h3 class="font-bold text-gray-800">Sécurité & Mot de passe</h3>
                    </div>
                    <form action="../actions/update_password.php" method="POST" class="p-8 space-y-6">
                        <div class="space-y-4">
                            <div>
                                <label class="block text-xs font-bold text-gray-400 uppercase mb-2">Mot de passe actuel</label>
                                <input type="password" name="old_password" placeholder="••••••••" class="w-full p-4 bg-gray-50 border-gray-200 rounded-2xl outline-none focus:ring-2 focus:ring-red-500">
                            </div>
                            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                                <div>
                                    <label class="block text-xs font-bold text-gray-400 uppercase mb-2">Nouveau mot de passe</label>
                                    <input type="password" name="new_password" placeholder="••••••••" class="w-full p-4 bg-gray-50 border-gray-200 rounded-2xl outline-none focus:ring-2 focus:ring-red-500">
                                </div>
                                <div>
                                    <label class="block text-xs font-bold text-gray-400 uppercase mb-2">Confirmer le mot de passe</label>
                                    <input type="password" name="confirm_password" placeholder="••••••••" class="w-full p-4 bg-gray-50 border-gray-200 rounded-2xl outline-none focus:ring-2 focus:ring-red-500">
                                </div>
                            </div>
                        </div>
                        <button type="submit" class="bg-red-600 text-white px-8 py-3 rounded-xl font-bold hover:bg-black transition shadow-lg shadow-red-100">Mettre à jour le mot de passe</button>
                    </form>
                </div>
            </div>
        </main>
    </div>

</body>
</html>