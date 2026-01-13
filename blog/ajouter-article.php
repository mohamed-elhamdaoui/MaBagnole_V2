<?php
require_once '../config.php';

if ($_SERVER["REQUEST_METHOD"] == 'POST' && isset($_POST["saveArticle"])) {

    $titre = $_POST["titre"];
    $contenu = $_POST["contenu"];
    $auteur_id = $_SESSION['id'];
    $image_url = $_POST["image"];
    $video_url = $_POST["video"];
    $theme_id = $_POST["theme"];

    $tagsArray = explode(',', $_POST['tags']);
    $article = new Article(
        $titre,
        $contenu,
        $auteur_id,
        $image_url,
        $video_url,
        $theme_id,
    );


    if ($article->ajouterArticle(tags: $tagsArray)) {
        header('Location: index.php?success=1');
        exit();
    } else {
        echo "Une erreur est survenue.";
    }
}

$themes = Theme::getAllTheme();

?>

<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Nouvel Article | MaBagnole</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <style>
        .form-glass {
            background: rgba(255, 255, 255, 0.02);
            backdrop-filter: blur(15px);
            border: 1px solid rgba(255, 255, 255, 0.05);
        }

        input,
        textarea,
        select {
            background: rgba(0, 0, 0, 0.3) !important;
            border: 1px solid rgba(255, 255, 255, 0.1) !important;
            transition: all 0.3s ease;
        }

        input:focus,
        textarea:focus,
        select:focus {
            border-color: #EE0000 !important;
            box-shadow: 0 0 15px rgba(238, 0, 0, 0.1);
            outline: none;
        }
    </style>
</head>

<body class="bg-[#0a0a0a] font-sans text-white">

    <?php include '../includes/header.php'; ?>

    <main class="container mx-auto px-6 pt-32 pb-20">

        <div class="max-w-4xl mx-auto mb-12">
            <span class="text-red-600 font-black uppercase tracking-[0.4em] text-xs">Atelier de Rédaction</span>
            <h1 class="text-5xl font-black uppercase italic tracking-tighter mt-4">
                CRÉER UN NOUVEL <span class="text-red-600">ARTICLE.</span>
            </h1>
            <p class="text-gray-500 font-bold mt-4 uppercase text-xs tracking-widest">
                Partagez votre passion avec la communauté MaBagnole.
            </p>
        </div>

        <div class="max-w-4xl mx-auto">
            <form action="" method="POST" class="form-glass p-8 md:p-12 rounded-[50px] shadow-2xl">

                <div class="grid grid-cols-1 md:grid-cols-2 gap-8 mb-10">
                    <div class="md:col-span-2">
                        <label class="block text-[10px] font-black uppercase tracking-widest text-red-600 mb-3">Titre de l'article</label>
                        <input type="text" name="titre" placeholder="Ex: Pourquoi la Porsche 911 est immortelle..."
                            class="w-full px-6 py-4 rounded-2xl text-white font-bold placeholder:text-gray-700">
                    </div>

                    <div>
                        <label class="block text-[10px] font-black uppercase tracking-widest text-red-600 mb-3">Thème Principal</label>
                        <select name="theme" class="w-full px-6 py-4 rounded-2xl text-white font-bold appearance-none cursor-pointer">
                            <option value="">Choisir un thème</option>
                            <?php foreach ($themes as $theme): ?>
                                <option value="<?= $theme->id ?>"><?= $theme->nom ?></option>
                            <?php endforeach; ?>

                        </select>
                    </div>

                    <div>
                        <label class="block text-[10px] font-black uppercase tracking-widest text-red-600 mb-3">Tags (Séparés par des virgules)</label>
                        <input type="text" name="tags" placeholder="Vitesse, Turbo, Circuit..."
                            class="w-full px-6 py-4 rounded-2xl text-white font-bold placeholder:text-gray-700">
                    </div>
                </div>

                <div class="grid grid-cols-1 md:grid-cols-2 gap-8 mb-10">
                    <div>
                        <label class="block text-[10px] font-black uppercase tracking-widest text-red-600 mb-3">URL Image de couverture</label>
                        <div class="relative">
                            <i class="fas fa-image absolute left-6 top-5 text-gray-600"></i>
                            <input type="text" name="image" placeholder="https://..."
                                class="w-full pl-14 pr-6 py-4 rounded-2xl text-white font-bold placeholder:text-gray-700">
                        </div>
                    </div>
                    <div>
                        <label class="block text-[10px] font-black uppercase tracking-widest text-red-600 mb-3">URL Vidéo (Optionnel)</label>
                        <div class="relative">
                            <i class="fas fa-play absolute left-6 top-5 text-gray-600"></i>
                            <input type="text" name="video" placeholder="Youtube / Vimeo link"
                                class="w-full pl-14 pr-6 py-4 rounded-2xl text-white font-bold placeholder:text-gray-700">
                        </div>
                    </div>
                </div>

                <div class="mb-12">
                    <label class="block text-[10px] font-black uppercase tracking-widest text-red-600 mb-3">Contenu de l'article</label>
                    <textarea name="contenu" rows="10" placeholder="Racontez votre histoire ici..."
                        class="w-full px-6 py-6 rounded-[30px] text-white font-medium italic leading-relaxed placeholder:text-gray-700"></textarea>
                </div>

                <div class="flex flex-col md:flex-row items-center justify-between gap-6 border-t border-white/5 pt-10">
                    <div class="flex items-center gap-2 text-gray-500">
                        <i class="fas fa-info-circle text-red-600"></i>
                        <p class="text-[9px] font-black uppercase tracking-widest">L'article sera soumis à validation par l'admin.</p>
                    </div>

                    <div class="flex gap-4">
                        <a href="index.php" class="px-10 py-4 rounded-full border border-white/10 text-[10px] font-black uppercase tracking-widest hover:bg-white hover:text-black transition">
                            Annuler
                        </a>
                        <button name="saveArticle" type="submit" class="bg-red-600 text-white px-12 py-4 rounded-full font-black text-[10px] uppercase tracking-widest hover:bg-white hover:text-red-600 transition-all duration-300 transform hover:scale-105 shadow-xl shadow-red-600/20">
                            Envoyer pour Approbation
                        </button>
                    </div>
                </div>
            </form>
        </div>
    </main>

    <?php include '../includes/footer.php'; ?>

</body>

</html>