<?php
require_once '../config.php';

$reservations = Reservation::getAllDetailed();

function getStatusColor($status)
{
    switch ($status) {
        case 'confirmee':
            return 'bg-green-100 text-green-700';
        case 'annulee':
            return 'bg-red-100 text-red-700';
        case 'terminee':
            return 'bg-blue-100 text-blue-700';
        default:
            return 'bg-yellow-100 text-yellow-700';
    }
}
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Réservations - Admin MaBagnole</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
    
    <link rel="stylesheet" href="https://cdn.datatables.net/2.1.8/css/dataTables.tailwindcss.css">

    <style>
        /* DataTables Custom Overrides */
        .dt-search input {
            background-color: #f9fafb;
            border-radius: 0.75rem;
            border: 1px solid #e5e7eb;
            padding: 0.5rem 1rem;
            font-size: 0.875rem;
            outline: none;
            transition: all 0.2s;
        }
        .dt-search input:focus {
            border-color: #dc2626;
            box-shadow: 0 0 0 1px #dc2626;
        }
        .dt-paging-button {
            border-radius: 0.75rem !important;
            font-weight: bold !important;
            margin: 0 2px !important;
        }
        .dt-paging-button.current {
            background: #111827 !important;
            color: white !important;
            border: none !important;
        }
        .dt-paging-button:hover:not(.current) {
            background: #f3f4f6 !important;
            color: #111827 !important;
            border: none !important;
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
                <a href="vehicules.php" class="flex items-center p-4 text-gray-500 hover:bg-gray-50 rounded-2xl transition font-bold">
                    <i class="fas fa-car mr-4"></i> Véhicules
                </a>
                <a href="categories.php" class="flex items-center p-4 text-gray-500 hover:bg-gray-50 rounded-2xl transition font-bold">
                    <i class="fas fa-tags mr-4"></i> Catégories
                </a>
                
                <a href="reservations.php" class="flex items-center p-4 text-red-600 bg-red-50 rounded-2xl font-black border-l-4 border-red-600 transition">
                    <i class="fas fa-calendar-check mr-4"></i> Réservations
                </a>
                
                <a href="articles.php" class="flex items-center p-4 text-gray-500 hover:bg-gray-50 rounded-2xl transition font-bold justify-between">
                    <div class="flex items-center">
                        <i class="fas fa-newspaper mr-4"></i> Blog / Articles
                    </div>
                    <span class="bg-red-600 text-white text-[10px] font-black px-2 py-1 rounded-full">3</span>
                </a>

                <a href="avis.php" class="flex items-center p-4 text-gray-500 hover:bg-gray-50 rounded-2xl transition font-bold">
                    <i class="fas fa-star mr-4"></i> Avis Clients
                </a>
                
                <div class="pt-10">
                    <a href="../index.php" class="flex items-center p-4 text-gray-400 hover:text-red-600 transition text-sm">
                        <i class="fas fa-eye mr-4"></i> Voir le site public
                    </a>
                </div>
            </nav>

            <div class="p-6 border-t border-gray-100">
                <a href="../auth/logout.php" class="flex items-center p-4 text-gray-400 hover:text-red-600 transition font-semibold">
                    <i class="fas fa-power-off mr-4"></i> Déconnexion
                </a>
            </div>
        </aside>

        <main class="flex-1 p-6 md:p-12 overflow-y-auto">

            <div class="flex flex-col md:flex-row justify-between items-start md:items-center mb-12 gap-4">
                <div>
                    <h1 class="text-4xl font-black text-gray-900">Suivi <span class="text-red-600 italic">Réservations.</span></h1>
                    <p class="text-gray-400">Validez ou gérez les demandes de location en cours.</p>
                </div>
                
                <div class="flex bg-white p-2 rounded-2xl shadow-sm border border-gray-100 space-x-2">
                    <button class="px-4 py-2 text-[10px] font-black uppercase rounded-xl bg-gray-900 text-white">Tous</button>
                    <button class="px-4 py-2 text-[10px] font-black uppercase rounded-xl text-gray-400 hover:bg-gray-50">En attente</button>
                    <button class="px-4 py-2 text-[10px] font-black uppercase rounded-xl text-gray-400 hover:bg-gray-50">Confirmées</button>
                </div>
            </div>

            <div class="bg-white rounded-[30px] shadow-sm border border-gray-100 overflow-x-auto p-4">
                <table id="reservationsTable" class="w-full text-left border-collapse min-w-[900px]">
                    <thead class="bg-gray-50 border-b border-gray-100">
                        <tr>
                            <th class="p-6 text-xs font-black text-gray-400 uppercase tracking-widest">Client</th>
                            <th class="p-6 text-xs font-black text-gray-400 uppercase tracking-widest">Véhicule</th>
                            <th class="p-6 text-xs font-black text-gray-400 uppercase tracking-widest">Période</th>
                            <th class="p-6 text-xs font-black text-gray-400 uppercase tracking-widest">Prix Total</th>
                            <th class="p-6 text-xs font-black text-gray-400 uppercase tracking-widest">Statut</th>
                            <th class="p-6 text-xs font-black text-gray-400 uppercase tracking-widest text-right">Actions</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-gray-50">
                        <?php foreach ($reservations as $r): ?>
                            <?php
                            $dateD = new DateTime($r["date_debut"]);
                            $dateF = new DateTime($r["date_fin"]);
                            $interval = $dateD->diff($dateF);
                            ?>
                            <tr class="group hover:bg-gray-50 transition">
                                
                                <td class="p-6">
                                    <div class="flex items-center gap-4">
                                        <div class="w-10 h-10 bg-red-50 text-red-600 rounded-full flex items-center justify-center font-black text-xs shadow-inner border border-red-100">
                                            <?= strtoupper(substr($r["prenom"], 0, 1)) ?>
                                        </div>
                                        <div>
                                            <h4 class="font-black text-gray-900 text-sm tracking-tight"><?= htmlspecialchars($r["prenom"] . " " . $r["nom"]) ?></h4>
                                            <p class="text-[10px] text-gray-400 italic"><?= htmlspecialchars($r["email"]) ?></p>
                                        </div>
                                    </div>
                                </td>

                                <td class="p-6">
                                    <span class="font-bold text-gray-700 text-sm"><?= htmlspecialchars($r["marque"]) ?></span>
                                    <span class="block text-[10px] text-gray-400 italic uppercase"><?= htmlspecialchars($r["modele"]) ?></span>
                                </td>

                                <td class="p-6">
                                    <div class="flex flex-col">
                                        <span class="text-xs font-bold text-gray-900">
                                            <?= $dateD->format('d/m') ?> <span class="text-red-400">→</span> <?= $dateF->format('d/m') ?>
                                        </span>
                                        <span class="text-[10px] text-gray-400 font-medium mt-1">
                                            <?= $interval->days + 1 ?> Jours • <?= htmlspecialchars($r["lieu_prise"]) ?>
                                        </span>
                                    </div>
                                </td>

                                <td class="p-6">
                                    <span class="font-black text-gray-900 text-sm"><?= number_format($r["total_prix"], 2) ?>€</span>
                                </td>

                                <td class="p-6">
                                    <span class="px-3 py-1 text-[9px] rounded-full font-black uppercase tracking-widest inline-block <?= getStatusColor($r['statut']) ?>">
                                        <?= str_replace('_', ' ', $r['statut']) ?>
                                    </span>
                                </td>

                                <td class="p-6 text-right">
                                    <?php if ($r['statut'] === 'en_attente'): ?>
                                        <div class="flex justify-end gap-2">
                                            <form action="../actions/update_reservation.php" method="POST" class="inline">
                                                <input type="hidden" name="res_id" value="<?= $r['id'] ?>">
                                                <input type="hidden" name="new_status" value="confirmee">
                                                <button type="submit" class="w-8 h-8 bg-green-50 text-green-600 rounded-xl hover:bg-green-600 hover:text-white transition shadow-sm flex items-center justify-center" title="Accepter">
                                                    <i class="fas fa-check text-xs"></i>
                                                </button>
                                            </form>

                                            <form action="../actions/update_reservation.php" method="POST" class="inline">
                                                <input type="hidden" name="res_id" value="<?= $r['id'] ?>">
                                                <input type="hidden" name="new_status" value="annulee">
                                                <button type="submit" onclick="return confirm('Refuser cette réservation ?')" class="w-8 h-8 bg-red-50 text-red-400 rounded-xl hover:bg-red-600 hover:text-white transition shadow-sm flex items-center justify-center" title="Refuser">
                                                    <i class="fas fa-times text-xs"></i>
                                                </button>
                                            </form>
                                        </div>
                                    <?php else: ?>
                                        <div class="flex justify-end">
                                            <button class="w-8 h-8 bg-gray-50 text-gray-400 rounded-xl hover:bg-gray-200 transition flex items-center justify-center" title="Voir détails">
                                                <i class="fas fa-eye text-xs"></i>
                                            </button>
                                        </div>
                                    <?php endif; ?>
                                </td>

                            </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>
            </div>

        </main>
    </div>

    <script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>
    <script src="https://cdn.datatables.net/2.1.8/js/dataTables.js"></script>
    <script src="https://cdn.datatables.net/2.1.8/js/dataTables.tailwindcss.js"></script>

    <script>
        $(document).ready(function() {
            $('#reservationsTable').DataTable({
                // French Language
                language: {
                    url: "//cdn.datatables.net/plug-ins/1.13.6/i18n/fr-FR.json"
                },
                
                // Config
                pageLength: 5,         // 5 rows per page
                lengthChange: false,   // Disable "Show entries" dropdown
                searching: true,       // Enable Search
                info: false,           // Disable "Showing 1 to 5" text
                ordering: true,        // Enable Sorting

                // Disable sorting on the Actions column (Last column)
                columnDefs: [
                    { orderable: false, targets: -1 } 
                ],

                // Layout: Search top-right, Pagination bottom-right
                layout: {
                    topStart: null,
                    topEnd: 'search',
                    bottomStart: null,
                    bottomEnd: 'paging'
                }
            });
        });
    </script>
</body>
</html>