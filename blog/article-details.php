<?php
require_once '../config.php';

$id = $_GET["id"] ?? 1; // Sécurité par défaut
// On récupère l'article
$article = Article::getArticleByid($id);
// On récupère d'autres articles pour la sidebar (suggestion)
$suggestions = Article::getArticleByTheme($id);

$commentaires = Commentaire::getAllCommentByArticle($id);

$latestArticlde = Article::getLatestArticle();

$nmbCommnt = Commentaire::cntCmntsUnderArticle($id);

$tagsByArticle = Article::getTagsByArticle($id);

function timeAgo($datetime)
{
    $now  = new DateTime();
    $ago  = new DateTime($datetime);
    $diff = $now->diff($ago);

    switch (true) {
        case ($diff->y > 0):
            return "il y a " . $diff->y . " an(s)";
        case ($diff->m > 0):
            return "il y a " . $diff->m . " mois";
        case ($diff->d > 0):
            return "il y a " . $diff->d . " jour(s)";
        case ($diff->h > 0):
            return "il y a " . $diff->h . " heure(s)";
        case ($diff->i > 0):
            return "il y a " . $diff->i . " minute(s)";
        default:
            return "à l'instant";
    }
}


if ($_SERVER["REQUEST_METHOD"] == 'POST') {

    if (isset($_SESSION["id"])) {
        if (!empty($_POST["contenu"]) && !empty($_POST["article_id"])) {
            $contenu = $_POST["contenu"];
            $article_id = $_POST["article_id"];

            $user_id = $_SESSION["id"];

            $commentaire = new Commentaire(
                $contenu,
                $user_id,
                $article_id
            );
            if ($commentaire->ajouterCommentaire()) {
                header("Location: /blog/article-details.php?id=$id");
                exit();
            }
        }
    } else {
        echo "Vous devez être connecté pour publier un commentaire.";
        // header("Location: login.php");
        // exit;

    }
}



?>

<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= htmlspecialchars($article["titre"]) ?></title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <style>
        html {
            scroll-behavior: smooth;
        }

        .glass-effect {
            background: rgba(255, 255, 255, 0.03);
            backdrop-filter: blur(12px);
            border: 1px solid rgba(255, 255, 255, 0.08);
        }

        .comment-line {
            position: relative;
        }

        .comment-line::before {
            content: '';
            position: absolute;
            left: 20px;
            top: 45px;
            bottom: 0;
            width: 2px;
            background: rgba(255, 255, 255, 0.05);
        }
    </style>
</head>

<body class="bg-[#0a0a0a] font-sans text-gray-200">

    <?php include '../includes/header.php'; ?>

    <nav class="container mx-auto px-6 pt-24 pb-6">
        <div class="flex items-center gap-2 text-[10px] font-black uppercase tracking-widest text-gray-500">
            <a href="../index.php" class="hover:text-red-600 transition">Accueil</a>
            <i class="fas fa-chevron-right text-[8px] text-red-600"></i>
            <span class="text-white">Détails Article</span>
        </div>
    </nav>

    <header class="container mx-auto px-6 mb-12">
        <div class="relative h-[50vh] rounded-[40px] overflow-hidden border border-white/5 shadow-2xl">
            <img src="<?= $article["image_url"] ?>" class="absolute inset-0 w-full h-full object-cover opacity-60">
            <div class="absolute inset-0 bg-gradient-to-t from-[#0a0a0a] via-[#0a0a0a]/40 to-transparent"></div>

            <div class="absolute bottom-10 left-10 right-10">
                <span class="bg-red-600 text-white px-4 py-1.5 rounded-lg text-[10px] font-bold uppercase tracking-widest mb-4 inline-block">
                    Mécanique & Performance
                </span>
                <h1 class="text-4xl md:text-6xl font-black text-white leading-tight uppercase italic tracking-tighter">
                    <?= htmlspecialchars($article["titre"]) ?>
                </h1>
            </div>
        </div>
    </header>

    <main class="container mx-auto px-6">
        <div class="grid grid-cols-1 lg:grid-cols-12 gap-12">

            <div class="lg:col-span-8">
                <article class="glass-effect p-8 md:p-12 rounded-[40px] mb-12">
                    <div class="prose prose-invert max-w-none">
                        <p class="text-xl text-gray-300 leading-relaxed italic mb-8 border-l-4 border-red-600 pl-6">
                            <?= nl2br(htmlspecialchars($article["contenu"])) ?>
                        </p>
                    </div>

                    <div class="flex flex-wrap items-center justify-between gap-4 pt-10 border-t border-white/5 mt-10">
                        <div class="flex gap-2">
                            <?php foreach ($tagsByArticle as $tag): ?>
                                <span class="bg-white/5 px-4 py-2 rounded-full text-[10px] font-bold text-gray-400 hover:bg-red-600 hover:text-white transition cursor-pointer">#<?= strtoupper($tag["nom"]) ?></span>
                            <?php endforeach; ?>
                            <!-- <span class="bg-white/5 px-4 py-2 rounded-full text-[10px] font-bold text-gray-400 hover:bg-red-600 hover:text-white transition cursor-pointer">#LUXE</span> -->
                        </div>
                        <div class="flex gap-4">
                            <button class="text-gray-400 hover:text-red-600 transition"><i class="fab fa-facebook-f"></i></button>
                            <button class="text-gray-400 hover:text-red-600 transition"><i class="fab fa-twitter"></i></button>
                            <button class="text-gray-400 hover:text-red-600 transition"><i class="fas fa-link"></i></button>
                        </div>
                    </div>
                </article>

                <section class="glass-effect p-8 rounded-[40px]">
                    <h3 class="text-2xl font-black uppercase italic mb-8">Discussions <span class="text-red-600">(<?= $nmbCommnt ?>)</span></h3>

                    <div class="flex gap-4 mb-12">
                        <div class="w-12 h-12 rounded-full bg-red-600 flex-shrink-0 flex items-center justify-center font-bold">M</div>
                        <form class="flex-1" action="" method="POST">
                            <textarea name="contenu" placeholder="Ajouter un commentaire public..."
                                class="w-full bg-transparent border-b border-white/10 focus:border-red-600 outline-none py-2 transition resize-none h-12 focus:h-24"></textarea>
                            <input type="hidden" name="article_id" value="<?= $id ?>">
                            <div class="flex justify-end mt-4">
                                <button type="submit"
                                    class="bg-red-600 text-white px-6 py-2 rounded-full text-[10px] font-black uppercase tracking-widest hover:bg-white hover:text-red-600 transition">
                                    Publier
                                </button>
                            </div>
                        </form>

                    </div>

                    <div class="space-y-8">
                        <?php if (!empty($commentaires)) : ?>
                            <?php foreach ($commentaires as $comm) : ?>
                                <div class="flex gap-4 comment-line">
                                    <img src="https://ui-avatars.com/api/?name=John+Doe&background=random" class="w-10 h-10 rounded-full object-cover">
                                    <div>
                                        <div class="flex items-center gap-3 mb-1">
                                            <span class="text-sm font-bold text-white"><?= $comm["nom"] . " " . $comm["prenom"] ?></span>
                                            <span class="text-[10px] text-gray-500 uppercase"><?= timeAgo($comm["created_at"]) ?></span>
                                        </div>
                                        <p class="text-gray-400 text-sm mb-3"><?= $comm["contenu"] ?></p>
                                        <div class="flex gap-6 items-center text-[10px] font-bold text-gray-500 tracking-widest uppercase">
                                            <button class="hover:text-red-600"><i class="far fa-thumbs-up mr-1"></i> 12</button>
                                            <button class="hover:text-red-600">Répondre</button>
                                        </div>
                                    </div>
                                </div>
                            <?php endforeach; ?>
                        <?php else : ?>
                            <p class="text-gray-400 italic text-center">Aucun commentaire pour le moment. Soyez le premier à réagir !</p>
                        <?php endif; ?>

                        <!-- <div class="flex gap-4 ml-14">
                            <img src="https://ui-avatars.com/api/?name=Admin&background=red&color=fff" class="w-8 h-8 rounded-full object-cover">
                            <div>
                                <div class="flex items-center gap-3 mb-1">
                                    <span class="text-sm font-bold text-white italic">L'Équipe MaBagnole</span>
                                    <span class="text-[10px] text-gray-500 uppercase">il y a 1 heure</span>
                                </div>
                                <p class="text-gray-400 text-sm mb-3">Merci John ! On prépare un dossier encore plus complet pour la semaine prochaine.</p>
                                <div class="flex gap-6 items-center text-[10px] font-bold text-gray-500 tracking-widest uppercase">
                                    <button class="hover:text-red-600"><i class="far fa-thumbs-up mr-1"></i> 2</button>
                                    <button class="hover:text-red-600">Répondre</button>
                                </div>
                            </div>
                        </div> -->
                    </div>
                </section>
            </div>

            <aside class="lg:col-span-4 space-y-8">
                <div class="glass-effect p-8 rounded-[40px]">
                    <h4 class="text-xl font-black uppercase italic mb-6 border-b border-red-600 pb-2 inline-block">À lire aussi</h4>

                    <div class="space-y-6">
                        <?php foreach ($latestArticlde as $art): ?>
                            <a href="#" class="group flex gap-4 items-center">
                                <div class="w-20 h-20 rounded-2xl overflow-hidden flex-shrink-0">
                                    <img src="<?= $art["image_url"] ?>" class="w-full h-full object-cover group-hover:scale-110 transition duration-500">
                                </div>
                                <div>
                                    <h5 class="text-sm font-bold leading-snug group-hover:text-red-600 transition"><?= $art["titre"] ?></h5>
                                    <span class="text-[10px] text-gray-500 uppercase tracking-tighter">5 min de lecture</span>
                                </div>
                            </a>
                        <?php endforeach; ?>
                    </div>

                </div>

                <div class="bg-red-600 p-8 rounded-[40px] relative overflow-hidden group">
                    <i class="fas fa-gas-pump absolute -right-4 -bottom-4 text-7xl text-black/10 group-hover:rotate-12 transition"></i>
                    <h4 class="text-xl font-black uppercase italic mb-2">Rejoins le club</h4>
                    <p class="text-sm text-white/80 mb-6">Reçois nos meilleurs conseils mécaniques chaque dimanche.</p>
                    <input type="email" placeholder="Ton email" class="w-full bg-white/10 border border-white/20 rounded-xl px-4 py-3 text-sm outline-none placeholder:text-white/40 mb-4">
                    <button class="w-full bg-white text-red-600 font-black uppercase text-[10px] py-3 rounded-xl hover:bg-[#0a0a0a] hover:text-white transition">S'inscrire</button>
                </div>
            </aside>

        </div>
    </main>

    <footer class="mt-24">
        <?php include '../includes/footer.php'; ?>
    </footer>

</body>

</html>