<?php
defined('_JEXEC') or die('Restricted access');

// Certificar-se de que os dados da model estão disponíveis
$stories = $this->get('Stories');

// Função para limitar o texto a um número máximo de palavras
function limitWords($text, $maxWords) {
    $words = explode(' ', $text);
    if (count($words) > $maxWords) {
        $words = array_slice($words, 0, $maxWords);
        $text = implode(' ', $words) . '...'; // Adiciona '...' para indicar truncamento
    }
    return $text;
}

// Função para limitar o texto a um número máximo de caracteres
function limitChars($text, $maxChars) {
    if (strlen($text) > $maxChars) {
        $text = substr($text, 0, $maxChars) . '...'; // Adiciona '...' para indicar truncamento
    }
    return $text;
}
?>
<!doctype html>
<html ⚡>
<head>
    <meta charset="utf-8">
    <title>Stories FelizComPouco</title>
    <link rel="canonical" href="<?php echo JURI::current(); ?>">
    <meta name="viewport" content="width=device-width,minimum-scale=1,initial-scale=1">
    <script async src="https://cdn.ampproject.org/v0.js"></script>
    <script async src="https://cdn.ampproject.org/v0/amp-story-1.0.js"></script>
    <style amp-boilerplate>
        body { visibility: hidden; opacity: 0; }
    </style>
    <noscript>
        <style amp-boilerplate>
            body { visibility: visible; opacity: 1; }
        </style>
    </noscript>
    <style amp-custom>
        amp-story {
            font-family: Arial, sans-serif;
            color: white;
        }
        amp-story-page {
            background-color: black;
        }
        h1, h2, p {
            margin: 0;
            padding: 20px;
        }
        .story-content {
            padding: 20px;
            background-color: rgba(0, 0, 0, 0.6);
        }
        .read-more {
            margin-top: 20px;
            font-size: 16px;
            color: #be83ea; /* Cor do link */
        }
        .read-more a {
            text-decoration: none;
            color: #be83ea;
        }
        .read-more a:hover {
            text-decoration: underline;
            color: #c4acd6;
        }
    </style>

    <!-- Adicionar o favicon -->
    <link rel="icon" type="image/x-icon" href="https://felizcompouco.com.br/images/Logo/favicon.png">
</head>
<body>
<amp-story standalone
           title="Histórias AMP"
           publisher="Seu Site"
           publisher-logo-src="https://pbs.twimg.com/profile_images/831152755150577664/HN9wYa5w_400x400.jpg"
           poster-portrait-src="https://pbs.twimg.com/profile_images/831152755150577664/HN9wYa5w_400x400.jpg">

    <?php if (!empty($stories)): ?>
        <?php foreach ($stories as $index => $story): ?>
            <?php
            // Use a URL da imagem da publicação, se estiver disponível
            $imageUrl = !empty($story->image_caption) ? $story->image_caption : "https://example.com/default-image.jpg"; // Substitua por uma URL padrão se não houver imagem
            $introtext = htmlspecialchars_decode($story->introtext);

            // Limitar o título e o texto introdutório
            $limitedTitle = limitWords($story->title, 20);
            $limitedIntrotext = limitWords($introtext, 550);
            ?>
            <amp-story-page id="story-<?php echo $index; ?>" auto-advance-after="5000">
                <amp-story-grid-layer template="fill">
                    <amp-img src="<?php echo $imageUrl; ?>"
                             width="720"
                             height="1280"
                             layout="responsive"
                             alt="<?php echo htmlspecialchars($story->title); ?>">
                    </amp-img>
                </amp-story-grid-layer>
                <amp-story-grid-layer template="vertical">
                    <div class="story-content">
                        <h1><?php echo htmlspecialchars($limitedTitle); ?></h1>
                        <!-- Exibir o conteúdo HTML interpretado e limitado -->
                        <?php echo $limitedIntrotext; ?>
                        <!-- Link "Leia Mais" com URL do item K2 -->
                        <div class="read-more">
                            <a href="<?php echo $story->link; ?>" target="_blank">Leia Mais</a>
                        </div>
                    </div>
                </amp-story-grid-layer>
            </amp-story-page>
        <?php endforeach; ?>
    <?php else: ?>
        <amp-story-page id="story-empty" auto-advance-after="5000">
            <amp-story-grid-layer template="fill">
                <h2>Nenhuma história encontrada.</h2>
            </amp-story-grid-layer>
        </amp-story-page>
    <?php endif; ?>

</amp-story>
</body>
</html>
