<?php
// file_mapped.php

// 1. Load feature map
$mapPath = __DIR__ . '/feature_map.json';
$featureMap = file_exists($mapPath)
    ? json_decode(file_get_contents($mapPath), true)
    : [];
if (!is_array($featureMap)) {
    $featureMap = [];
}

// 2. Define the base directory
$baseDir = __DIR__;

// If ?file= is set, return raw file contents
if (isset($_GET['file'])) {
    $f = realpath($baseDir . '/' . $_GET['file']);
    if ($f !== false && strpos($f, $baseDir) === 0 && is_file($f)) {
        echo htmlentities(file_get_contents($f));
    } else {
        echo "Invalid file!";
    }
    exit;
}

// 3. Build the directory tree (exclude .git, etc.)
function getTree($dir)
{
    $result = [];
    foreach (scandir($dir) as $item) {
        if (
            $item === '.' ||
            $item === '..' ||
            $item === 'file.php' ||
            $item === 'file_mapped.php' ||
            $item === 'seed_admin.php' ||
            $item === '.git'
        ) {
            continue;
        }
        $path = $dir . '/' . $item;
        if (is_dir($path)) {
            $result[$item] = getTree($path);
        } else {
            $result[] = $item;
        }
    }
    return $result;
}

// 4. Print the directory tree as nested <ul>
function printTree($tree, $c = '')
{
    echo '<ul>';
    foreach ($tree as $key => $value) {
        if (is_array($value)) {
            // It's a folder
            $fp = ltrim("$c/$key", '/');
            echo "<li class='folder' data-p='" . htmlspecialchars($fp) . "'>"
                . "<span onclick='toggleFolder(this)'>" . htmlspecialchars($key) . "</span> "
                . "<small>($fp)</small>";
            printTree($value, $fp);
            echo '</li>';
        } else {
            // It's a file
            $fp = ltrim("$c/$value", '/');
            echo "<li class='file' data-p='" . htmlspecialchars($fp) . "'>"
                . "<span onclick='toggleFile(this)'>" . htmlspecialchars($value) . "</span> "
                . "<small>($fp)</small>"
                . "<div class='fc'></div></li>";
        }
    }
    echo '</ul>';
}

// 5. Generate the tree for the base directory
$tree = getTree($baseDir);
?>
<!DOCTYPE html>
<html>
<head>
<meta charset="UTF-8">
<title>Directory Tree with Feature Map</title>
<style>
body { font-family: sans-serif; margin: 20px; }
ul { list-style: none; padding-left: 20px; }
li { margin: 5px 0; }
.folder > ul { display: block; }
.fc {
    display: none;
    margin-left: 20px;
    border: 1px solid #ccc;
    padding: 10px;
    white-space: pre-wrap;
    background: #f7f7f7;
}
button {
    margin-right: 8px;
    cursor: pointer;
}
.feature-buttons {
    margin-bottom: 1em;
}
.feature-buttons button {
    margin-right: 10px;
    padding: 5px 8px;
}
</style>
</head>
<body>

<h1>Project Directory & Feature Map</h1>

<!-- Basic folder/file expansion controls -->
<div>
  <button onclick="exAll()">Expand All Folders</button>
  <button onclick="openAll()">Open All Files</button>
  <button onclick="clAll()">Collapse All</button>
</div>

<!-- Buttons to open mapped files for each feature -->
<div class="feature-buttons">
  <h3>Open Mapped Files by Feature</h3>
  <?php foreach ($featureMap as $featName => $paths): ?>
    <button onclick="openFeature('<?php echo htmlspecialchars($featName); ?>')">
      <?php echo htmlspecialchars($featName); ?>
    </button>
  <?php endforeach; ?>
</div>

<!-- Print the entire directory tree -->
<?php printTree($tree); ?>

<script>
// 6. Make the feature map available to JavaScript
var FEATURE_MAP = <?php echo json_encode($featureMap); ?>;

// Toggle folder display
function toggleFolder(span){
  let ul = span.parentNode.querySelector(":scope>ul");
  if (ul) {
    ul.style.display = (ul.style.display === 'none' ? 'block' : 'none');
  }
}

// Toggle single file content (on/off)
function toggleFile(span){
  let li = span.parentNode;
  let fc = li.querySelector(".fc");
  // If file content not already loaded, load it
  if (!fc.innerHTML.trim()) {
    loadFile(li.dataset.p, fc);
  } else {
    // Otherwise toggle its visibility
    fc.style.display = (fc.style.display === 'none' ? 'block' : 'none');
  }
}

// Expand all folders
function exAll(){
  document.querySelectorAll('.folder>ul').forEach(u => {
    u.style.display = 'block';
  });
}

// Collapse all (folders + file contents)
function clAll(){
  document.querySelectorAll('.folder>ul').forEach(u => {
    u.style.display = 'none';
  });
  document.querySelectorAll('.fc').forEach(c => {
    c.style.display = 'none';
  });
}

// Open all files (load content for every file)
function openAll(){
  let files = document.querySelectorAll('.file');
  files.forEach(li => {
    let fc = li.querySelector('.fc');
    if (!fc.innerHTML.trim()) {
      loadFile(li.dataset.p, fc, true);
    } else {
      fc.style.display = 'block';
    }
  });
}

// Open only the mapped files for a given feature
function openFeature(featureName){
  let mappedFiles = FEATURE_MAP[featureName];
  if (!mappedFiles) return;
  // Expand folders first
  exAll();
  mappedFiles.forEach(path => {
    // Locate the <li class='file' data-p="path">
    let li = document.querySelector(`.file[data-p="${path}"]`);
    if (li) {
      let fc = li.querySelector('.fc');
      // Load if not loaded, otherwise just show
      if (!fc.innerHTML.trim()) {
        loadFile(path, fc, true);
      } else {
        fc.style.display = 'block';
      }
    }
  });
}

// Reusable Ajax function to load file contents
function loadFile(path, container, showAfterLoad = false){
  let x = new XMLHttpRequest();
  x.open("GET", "?file=" + encodeURIComponent(path));
  x.onload = () => {
    container.innerHTML = '<pre>' + x.responseText + '</pre>';
    container.style.display = showAfterLoad ? 'block' : 'none';
  };
  x.send();
}
</script>

</body>
</html>
