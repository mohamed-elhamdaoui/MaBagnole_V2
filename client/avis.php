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

// 3. Fetch User's Reviews using Class
$mesAvis = Avis::getByUserId($user_id);
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Mes Avis - MaBagnole</title>
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
    
    <a href="avis.php" class="flex items-center p-4 text-gray-900 bg-gray-50 rounded-2xl font-bold border-l-4 border-red-600">
        <i class="fas fa-star mr-4 text-red-600"></i> Mes Avis
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

    <a href="profil.php" class="flex items-center p-4 text-gray-500 hover:bg-gray-50 rounded-2xl transition">
        <i class="fas fa-user-circle mr-4"></i> Mon Profil
    </a>
</nav>

            <div class="p-6 border-t border-gray-100">
                <a href="../auth/logout.php" class="flex items-center p-4 text-red-400 hover:text-red-600 transition font-semibold">
                    <i class="fas fa-power-off mr-4"></i> Déconnexion
                </a>
            </div>
        </aside>

        <main class="flex-1 p-6 md:p-12">
            <div class="max-w-5xl mx-auto">
                <div class="flex justify-between items-center mb-8">
                    <h1 class="text-3xl font-black text-gray-900">Gérer mes <span class="text-red-600">Avis.</span></h1>
                    <a href="catalogue.php" class="bg-gray-900 text-white px-6 py-3 rounded-xl font-bold shadow-lg hover:bg-red-600 transition text-xs uppercase tracking-widest flex items-center">
                        <i class="fas fa-plus mr-2"></i> Louer & Noter
                    </a>
                </div>

                <div class="grid grid-cols-1 gap-6">
                    
                    <?php if (count($mesAvis) > 0): ?>
                        <?php foreach($mesAvis as $avis): ?>
                        <div class="bg-white p-6 rounded-3xl shadow-sm border border-gray-100 hover:shadow-md transition duration-300">
                            <div class="flex justify-between items-start mb-4">
                                <div>
                                    <h3 class="font-bold text-lg text-gray-800 uppercase tracking-wide">
                                        <?= htmlspecialchars($avis['marque']) ?> <span class="text-red-600 italic"><?= htmlspecialchars($avis['modele']) ?></span>
                                    </h3>
                                    <div class="flex text-yellow-400 text-xs mt-1 gap-1">
                                        <?php 
                                        for($i=1; $i<=5; $i++) {
                                            echo ($i <= $avis['note']) ? '<i class="fas fa-star"></i>' : '<i class="far fa-star text-gray-300"></i>';
                                        }
                                        ?>
                                        <span class="ml-2 text-gray-300 font-bold"><?= $avis['note'] ?>/5</span>
                                    </div>
                                </div>
                                <span class="text-[10px] text-gray-400 font-bold bg-gray-50 px-3 py-1 rounded-full uppercase tracking-wider">
                                    <?= date('d M Y', strtotime($avis['created_at'])) ?>
                                </span>
                            </div>
                            
                            <div class="bg-gray-50 p-6 rounded-2xl mb-6 border border-gray-100/50">
                                <p class="text-gray-600 italic text-sm leading-relaxed">"<?= htmlspecialchars($avis['commentaire']) ?>"</p>
                            </div>
                            
                            <div class="flex justify-end gap-4 border-t border-gray-100 pt-4">
                                <button onclick="openEditModal(<?= $avis['id'] ?>, '<?= htmlspecialchars($avis['commentaire'], ENT_QUOTES) ?>', <?= $avis['note'] ?>)" 
                                        class="text-blue-600 text-xs font-bold hover:bg-blue-50 px-4 py-2 rounded-xl transition flex items-center">
                                    <i class="fas fa-pen mr-2"></i> Modifier
                                </button>
                                
                                <form action="actions/soft_delete_avis.php" method="POST" onsubmit="return confirm('Voulez-vous vraiment supprimer cet avis ?');">
                                    <input type="hidden" name="avis_id" value="<?= $avis['id'] ?>">
                                    <button type="submit" class="text-red-500 text-xs font-bold hover:bg-red-50 px-4 py-2 rounded-xl transition flex items-center">
                                        <i class="fas fa-trash-alt mr-2"></i> Supprimer
                                    </button>
                                </form>
                            </div>
                        </div>
                        <?php endforeach; ?>
                    <?php else: ?>
                        <div class="text-center py-20 bg-white rounded-3xl border border-dashed border-gray-200">
                            <i class="fas fa-comment-slash text-4xl text-gray-300 mb-4"></i>
                            <h3 class="text-lg font-bold text-gray-500">Aucun avis publié</h3>
                            <p class="text-gray-400 text-sm">Vos futurs avis apparaîtront ici.</p>
                        </div>
                    <?php endif; ?>

                </div>
            </div>

            <div id="editModal" class="hidden fixed inset-0 bg-black/60 backdrop-blur-sm flex items-center justify-center z-50 transition-all duration-300">
                <div class="bg-white rounded-[30px] p-8 max-w-md w-full shadow-2xl transform scale-95 transition-transform">
                    <div class="flex justify-between items-center mb-6">
                        <h2 class="text-2xl font-black text-gray-900">Modifier mon <span class="text-red-600">Avis</span></h2>
                        <button onclick="closeModal()" class="text-gray-400 hover:text-red-600 transition"><i class="fas fa-times text-xl"></i></button>
                    </div>
                    
                    <form action="actions/edit_avis.php" method="POST" class="space-y-5">
                        <input type="hidden" name="avis_id" id="modal_avis_id">
                        
                        <div>
                            <label class="block text-xs font-black text-gray-400 uppercase mb-2 tracking-widest">Note (1 à 5)</label>
                            <div class="relative">
                                <input type="number" name="note" id="modal_note" min="1" max="5" required
                                       class="w-full p-4 bg-gray-50 border border-gray-200 rounded-2xl outline-none focus:border-red-600 focus:ring-1 focus:ring-red-600 transition font-bold text-gray-800">
                                <i class="fas fa-star absolute right-4 top-5 text-yellow-400 pointer-events-none"></i>
                            </div>
                        </div>
                        
                        <div>
                            <label class="block text-xs font-black text-gray-400 uppercase mb-2 tracking-widest">Votre commentaire</label>
                            <textarea name="commentaire" id="modal_comment" rows="4" required
                                      class="w-full p-4 bg-gray-50 border border-gray-200 rounded-2xl outline-none focus:border-red-600 focus:ring-1 focus:ring-red-600 transition font-medium text-gray-700 placeholder-gray-400"></textarea>
                        </div>
                        
                        <div class="flex justify-end gap-3 pt-4">
                            <button type="button" onclick="closeModal()" class="text-gray-500 font-bold px-6 py-3 rounded-xl hover:bg-gray-100 transition text-xs uppercase tracking-wider">Annuler</button>
                            <button type="submit" class="bg-red-600 text-white px-8 py-3 rounded-xl font-bold shadow-lg shadow-red-200 hover:bg-black transition text-xs uppercase tracking-wider">Enregistrer</button>
                        </div>
                    </form>
                </div>
            </div>
        </main>
    </div>

    <script>
        function openEditModal(id, comment, note) {
            document.getElementById('modal_avis_id').value = id;
            document.getElementById('modal_comment').value = comment;
            document.getElementById('modal_note').value = note;
            
            const modal = document.getElementById('editModal');
            modal.classList.remove('hidden');
            setTimeout(() => {
                modal.firstElementChild.classList.remove('scale-95');
                modal.firstElementChild.classList.add('scale-100');
            }, 10);
        }

        function closeModal() {
            const modal = document.getElementById('editModal');
            modal.firstElementChild.classList.remove('scale-100');
            modal.firstElementChild.classList.add('scale-95');
            setTimeout(() => {
                modal.classList.add('hidden');
            }, 200);
        }
    </script>
</body>
</html>