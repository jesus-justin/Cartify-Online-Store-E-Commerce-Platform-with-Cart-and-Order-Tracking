<?php
include 'Php/db_connect.php';

// Define overrides with keywords and correct descriptions
$overrides = [
    'external_hdd' => [
        'keywords' => ['external hard drive', 'external hdd', 'portable hdd', 'external drive'],
        'description' => 'Portable external hard drive — USB 3.0 / USB‑C, reliable storage for backups and large files.'
    ],
    'webcam' => [
        'keywords' => ['webcam', 'camera webcam', 'usb webcam'],
        'description' => '1080p HD webcam with built-in mic — optimized for video calls and live streaming.'
    ],
    'router' => [
        'keywords' => ['router', 'wi-fi router', 'wifi router', 'modem router'],
        'description' => 'Dual-band Wi‑Fi router delivering stable range and high throughput for home networks.'
    ],
    'powerbank' => [
        'keywords' => ['powerbank', 'power bank', 'portable charger'],
        'description' => 'High-capacity power bank with fast-charge support for phones and tablets on the go.'
    ],
    'microphone' => [
        'keywords' => ['microphone', 'mic', 'condensor microphone', 'condenser microphone'],
        'description' => 'Condenser microphone — clear voice capture for streaming, podcasting, and calls.'
    ],
    'graphics_card' => [
        'keywords' => ['graphics card', 'gpu', 'video card'],
        'description' => 'High-performance graphics card for gaming and GPU-accelerated creative workloads.'
    ],
    'tablet' => [
        'keywords' => ['tablet', 'ipad', 'android tablet'],
        'description' => 'Slim tablet with vivid display — ideal for media consumption, reading, and light productivity.'
    ],
    'vr_headset' => [
        'keywords' => ['vr headset', 'vr', 'virtual reality', 'vr goggles'],
        'description' => 'Immersive VR headset with wide field of view — perfect for gaming and virtual experiences.'
    ],
    'drone' => [
        'keywords' => ['drone', 'quadrocopter', 'uav'],
        'description' => 'Compact camera drone with stabilized flight and aerial photography capabilities.'
    ],
    'smart_home_hub' => [
        'keywords' => ['smart home hub', 'smart hub', 'home hub', 'smart home'],
        'description' => 'Smart home hub to connect and control lights, locks, and sensors from one place.'
    ]
];

// Fetch all products
$sql = "SELECT id, name, description FROM products";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        $id = $row['id'];
        $name = strtolower(trim($row['name']));
        $current_desc = $row['description'];

        $new_desc = $current_desc; // Default to current

        // Check for matches
        foreach ($overrides as $ov) {
            foreach ($ov['keywords'] as $kw) {
                if (stripos($name, strtolower($kw)) !== false) {
                    $new_desc = $ov['description'];
                    break 2;
                }
            }
        }

        // Update if description changed
        if ($new_desc !== $current_desc) {
            $update_sql = "UPDATE products SET description = ? WHERE id = ?";
            $stmt = $conn->prepare($update_sql);
            $stmt->bind_param("si", $new_desc, $id);
            $stmt->execute();
            $stmt->close();
            echo "Updated product ID $id: $row[name] - New description: $new_desc\n";
        }
    }
} else {
    echo "No products found.\n";
}

$conn->close();
echo "Description updates completed.\n";
?>
