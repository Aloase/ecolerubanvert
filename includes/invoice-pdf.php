<?php
/**
 * Ecole Ruban Vert — Generation de devis / facture PDF (module Location d'espaces)
 */
require_once __DIR__ . '/../vendor/autoload.php';

use Dompdf\Dompdf;
use Dompdf\Options;

/**
 * Genere un PDF de devis/facture pour une reservation et le sauvegarde sur disque.
 * Retourne le chemin relatif (depuis la racine du site) du PDF genere.
 */
function rental_generate_invoice_pdf(array $booking, array $space, string $invoiceNumber): string {
    $amount = $booking['quote_amount'] !== null ? number_format((float)$booking['quote_amount'], 0, ',', ' ') . ' FCFA' : 'Sur devis';
    $status = $booking['status'] === 'confirmee' ? 'FACTURE' : 'DEVIS';

    $html = '
    <html><head><meta charset="UTF-8"><style>
      body { font-family: DejaVu Sans, sans-serif; color:#243B2A; font-size: 13px; }
      h1 { color:#1F5B3B; font-size: 22px; margin-bottom:0; }
      .muted { color:#6B7A72; }
      table { width:100%; border-collapse: collapse; margin-top: 20px; }
      td, th { padding:8px 10px; border-bottom:1px solid #E3E7E5; text-align:left; }
      .total { font-size:16px; font-weight:bold; color:#1F5B3B; }
      .header { border-bottom:3px solid #1F5B3B; padding-bottom:10px; margin-bottom:20px; }
    </style></head><body>
      <div class="header">
        <h1>Ecole Ruban Vert</h1>
        <div class="muted">International School &middot; Libreville, Gabon</div>
      </div>
      <h2>' . $status . ' N&deg; ' . htmlspecialchars($invoiceNumber) . '</h2>
      <p class="muted">Date d\'emission : ' . date('d/m/Y') . '</p>
      <table>
        <tr><th>Client</th><td>' . htmlspecialchars($booking['renter_name']) . ($booking['renter_org'] ? ' (' . htmlspecialchars($booking['renter_org']) . ')' : '') . '</td></tr>
        <tr><th>Email</th><td>' . htmlspecialchars($booking['renter_email']) . '</td></tr>
        <tr><th>Telephone</th><td>' . htmlspecialchars($booking['renter_phone']) . '</td></tr>
        <tr><th>Reference reservation</th><td>' . htmlspecialchars($booking['reference_code']) . '</td></tr>
      </table>
      <table>
        <tr><th>Espace loue</th><th>Date</th><th>Horaire</th><th>Montant</th></tr>
        <tr>
          <td>' . htmlspecialchars($space['name']) . '</td>
          <td>' . date('d/m/Y', strtotime($booking['booking_date'])) . '</td>
          <td>' . substr($booking['start_time'], 0, 5) . '&ndash;' . substr($booking['end_time'], 0, 5) . '</td>
          <td class="total">' . $amount . '</td>
        </tr>
      </table>
      <p style="margin-top:40px;" class="muted">Ce document est genere automatiquement et vaut ' . strtolower($status) . ' pour la location de l\'espace mentionne ci-dessus. Pour toute question, contactez l\'ecole.</p>
    </body></html>';

    $options = new Options();
    $options->set('isRemoteEnabled', false);
    $dompdf = new Dompdf($options);
    $dompdf->loadHtml($html);
    $dompdf->setPaper('A4', 'portrait');
    $dompdf->render();

    $dir = dirname(__DIR__) . '/uploads/invoices';
    if (!is_dir($dir)) {
        mkdir($dir, 0755, true);
    }
    $filename = $invoiceNumber . '.pdf';
    file_put_contents($dir . '/' . $filename, $dompdf->output());

    return 'uploads/invoices/' . $filename;
}
