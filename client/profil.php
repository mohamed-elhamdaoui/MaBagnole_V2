<?php
require_once '../config.php';

// 1. Session Check
if (!isset($_SESSION['id'])) {
    header("Location: login.php");
    exit();
}

$user_id = $_SESSION['id'];
$pdo = DbConnection::getConnection();

// 2. Fetch User Info
$stmtUser = $pdo->prepare("SELECT * FROM users WHERE id = ?");
$stmtUser->execute([$user_id]);
$user = $stmtUser->fetch(PDO::FETCH_ASSOC);

// Handle Success/Error Messages from actions
$message = "";
$msgType = ""; // 'success' or 'error'

if (isset($_GET['success'])) {
    $msgType = 'success';
    if ($_GET['success'] == 'profile_updated') $message = "Profil mis à jour avec succès.";
    if ($_GET['success'] == 'password_updated') $message = "Mot de passe modifié avec succès.";
}
if (isset($_GET['error'])) {
    $msgType = 'error';
    if ($_GET['error'] == 'wrong_password') $message = "L'ancien mot de passe est incorrect.";
    if ($_GET['error'] == 'mismatch') $message = "Les nouveaux mots de passe ne correspondent pas.";
    if ($_GET['error'] == 'update_failed') $message = "Erreur lors de la mise à jour.";
}
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Mon Profil - MaBagnole</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
</head>
<body class="bg-gray-50 font-sans">

    <nav class="bg-white border-b border-gray-200 px-6 py-4 flex justify-between items-center md:hidden">
        <span class="font-bold text-red-600 italic">MaBagnole</span>
        <button class="text-gray-500"><i class="fas fa-bars text-xl"></i></button>
    </nav>

    <div class="flex min-h-screen">
        
        <aside class="w-72 bg-white border-r border-gray-200 flex-shrink-0 hidden md:flex flex-col">
            <div class="p-8 text-center">
                <div class="w-24 h-24 bg-gradient-to-tr from-red-600 to-red-400 text-white rounded-3xl flex items-center justify-center mx-auto mb-4 text-3xl font-black shadow-lg shadow-red-100 rotate-3">
                    <?= strtoupper(substr($user['nom'], 0, 1)) ?>
                </div>
                <h2 class="font-bold text-gray-900 text-xl"><?= htmlspecialchars($user['nom'] . ' ' . $user['prenom']) ?></h2>
                <span class="text-[10px] bg-gray-100 px-2 py-1 rounded-full uppercase font-bold text-gray-400">Client Premium</span>
            </div>
            
            <nav class="flex-1 px-6 space-y-1">
    <a href="dashboard.php" class="flex items-center p-4 text-gray-500 hover:bg-gray-50 rounded-2xl transition">
        <i class="fas fa-calendar-check mr-4"></i> Mes Locations
    </a>
    
    <a href="avis.php" class="flex items-center p-4 text-gray-500 hover:bg-gray-50 rounded-2xl transition">
        <i class="fas fa-star mr-4"></i> Mes Avis
    </a>

    <div class="my-4 border-t border-gray-100 mx-4"></div>
    <span class="px-4 text-[10px] uppercase font-bold text-gray-400 tracking-widest">Blog & Communauté</span>

    <a href="mes_articles.php" class="flex items-center p-4 text-gray-500 hover:bg-gray-50 rounded-2xl transition">
        <i class="fas fa-pen-nib mr-4"></i> Mes Articles
    </a>

    <a href="articles_favoris.php" class="flex items-center p-4 text-gray-500 hover:bg-gray-50 rounded-2xl transition group">
        <i class="fas fa-bookmark mr-4 group-hover:text-red-600 transition"></i> Articles Favoris
    </a>

    <div class="my-4 border-t border-gray-100 mx-4"></div>

    <a href="profil.php" class="flex items-center p-4 text-gray-900 bg-gray-50 rounded-2xl font-bold border-l-4 border-red-600">
        <i class="fas fa-user-circle mr-4 text-red-600"></i> Mon Profil
    </a>
</nav>

            <div class="p-6 border-t border-gray-100">
                <a href="../auth/logout.php" class="flex items-center p-4 text-red-400 hover:text-red-600 transition font-semibold">
                    <i class="fas fa-power-off mr-4"></i> Déconnexion
                </a>
            </div>
        </aside>

        <main class="flex-1 p-6 md:p-12">
            <div class="max-w-3xl mx-auto">
                <div class="flex flex-col md:flex-row justify-between items-start md:items-center mb-8 gap-4">
                    <h1 class="text-3xl font-black text-gray-900">Paramètres du <span class="text-red-600">Compte.</span></h1>
                </div>

                <?php if ($message): ?>
                <div class="mb-8 p-4 rounded-2xl flex items-center gap-3 <?= $msgType == 'success' ? 'bg-green-50 text-green-600 border border-green-100' : 'bg-red-50 text-red-600 border border-red-100' ?>">
                    <i class="fas <?= $msgType == 'success' ? 'fa-check-circle' : 'fa-exclamation-circle' ?>"></i>
                    <span class="font-bold text-sm"><?= $message ?></span>
                </div>
                <?php endif; ?>

                <div class="bg-white rounded-3xl shadow-sm border border-gray-100 overflow-hidden mb-8">
                    <div class="p-6 border-b border-gray-50 bg-gray-50/50">
                        <h3 class="font-bold text-gray-800 flex items-center">
                            <i class="fas fa-address-card mr-3 text-gray-400"></i> Informations Personnelles
                        </h3>
                    </div>
                    
                    <form action="actions/update_profile.php" method="POST" class="p-8 space-y-6">
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                            <div>
                                <label class="block text-xs font-bold text-gray-400 uppercase mb-2 tracking-wider">Nom</label>
                                <input type="text" name="nom" value="<?= htmlspecialchars($user['nom']) ?>" required
                                       class="w-full p-4 bg-gray-50 border border-gray-100 rounded-2xl outline-none focus:border-red-500 focus:ring-1 focus:ring-red-500 transition-all font-bold text-gray-700">
                            </div>
                            <div>
                                <label class="block text-xs font-bold text-gray-400 uppercase mb-2 tracking-wider">Prénom</label>
                                <input type="text" name="prenom" value="<?= htmlspecialchars($user['prenom']) ?>" required
                                       class="w-full p-4 bg-gray-50 border border-gray-100 rounded-2xl outline-none focus:border-red-500 focus:ring-1 focus:ring-red-500 transition-all font-bold text-gray-700">
                            </div>
                            <div class="md:col-span-2">
                                <label class="block text-xs font-bold text-gray-400 uppercase mb-2 tracking-wider">Adresse Email</label>
                                <input type="email" name="email" value="<?= htmlspecialchars($user['email']) ?>" required
                                       class="w-full p-4 bg-gray-50 border border-gray-100 rounded-2xl outline-none focus:border-red-500 focus:ring-1 focus:ring-red-500 transition-all font-bold text-gray-700">
                            </div>
                        </div>
                        
                        <div class="flex justify-end">
                            <button type="submit" class="bg-gray-900 text-white px-8 py-3 rounded-xl font-bold hover:bg-red-600 transition shadow-lg text-xs uppercase tracking-widest">
                                Sauvegarder les modifications
                            </button>
                        </div>
                    </form>
                </div>

                <div class="bg-white rounded-3xl shadow-sm border border-gray-100 overflow-hidden">
                    <div class="p-6 border-b border-gray-50 bg-gray-50/50">
                        <h3 class="font-bold text-gray-800 flex items-center">
                            <i class="fas fa-shield-alt mr-3 text-gray-400"></i> Sécurité & Mot de passe
                        </h3>
                    </div>
                    
                    <form action="actions/update_password.php" method="POST" class="p-8 space-y-6">
                        <div class="space-y-4">
                            <div>
                                <label class="block text-xs font-bold text-gray-400 uppercase mb-2 tracking-wider">Mot de passe actuel</label>
                                <input type="password" name="old_password" placeholder="••••••••" required
                                       class="w-full p-4 bg-gray-50 border border-gray-100 rounded-2xl outline-none focus:border-red-500 focus:ring-1 focus:ring-red-500 transition-all">
                            </div>
                            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                                <div>
                                    <label class="block text-xs font-bold text-gray-400 uppercase mb-2 tracking-wider">Nouveau mot de passe</label>
                                    <input type="password" name="new_password" placeholder="••••••••" required
                                           class="w-full p-4 bg-gray-50 border border-gray-100 rounded-2xl outline-none focus:border-red-500 focus:ring-1 focus:ring-red-500 transition-all">
                                </div>
                                <div>
                                    <label class="block text-xs font-bold text-gray-400 uppercase mb-2 tracking-wider">Confirmer le mot de passe</label>
                                    <input type="password" name="confirm_password" placeholder="••••••••" required
                                           class="w-full p-4 bg-gray-50 border border-gray-100 rounded-2xl outline-none focus:border-red-500 focus:ring-1 focus:ring-red-500 transition-all">
                                </div>
                            </div>
                        </div>
                        
                        <div class="flex justify-end">
                            <button type="submit" class="bg-red-600 text-white px-8 py-3 rounded-xl font-bold hover:bg-black transition shadow-lg shadow-red-100 text-xs uppercase tracking-widest">
                                Mettre à jour le mot de passe
                            </button>
                        </div>
                    </form>
                </div>

            </div>
        </main>
    </div>

</body>
</html>