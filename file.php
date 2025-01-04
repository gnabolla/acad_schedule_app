<?php
// Base directory to browse (change as needed).
$baseDir = __DIR__;

// Return file contents if ?file= is set.
if (isset($_GET['file'])) {
    $f = realpath($baseDir . '/' . $_GET['file']);
    if ($f !== false && strpos($f, $baseDir) === 0 && is_file($f)) {
        echo htmlentities(file_get_contents($f));
    } else {
        echo "Invalid file!";
    }
    exit;
}

// Build directory tree recursively.
function getTree($d) {
    $r = [];
    foreach (scandir($d) as $i) {
        // Exclude these files and directories:
        if (
            $i === '.' ||
            $i === '..' ||
            $i === 'file.php' ||
            // $i === 'acad_schedule_db.php' ||
            // $i === 'acad_schedule_db.sql' ||
            $i === 'seed_admin.php'
        ) {
            continue;
        }

        $p = $d . '/' . $i;
        if (is_dir($p)) {
            $r[$i] = getTree($p);
        } else {
            $r[] = $i;
        }
    }
    return $r;
}

// Print directory tree as nested <ul>.
function printTree($t, $c = '') {
    echo '<ul>';
    foreach ($t as $k => $v) {
        if (is_array($v)) {
            $fp = ltrim("$c/$k", '/');
            echo "<li class='folder' data-p='" . htmlspecialchars($fp) . "'>"
               . "<span onclick='toggleFolder(this)'>" . htmlspecialchars($k) . "</span> "
               . "<small>($fp)</small>";
            printTree($v, $fp);
            echo '</li>';
        } else {
            $fp = ltrim("$c/$v", '/');
            echo "<li class='file' data-p='" . htmlspecialchars($fp) . "'>"
               . "<span onclick='toggleFile(this)'>" . htmlspecialchars($v) . "</span> "
               . "<small>($fp)</small>"
               . "<div class='fc'></div></li>";
        }
    }
    echo '</ul>';
}

// Generate the tree and render the page.
$t = getTree($baseDir);
?>
<!DOCTYPE html>
<html>
<head>
<meta charset="UTF-8">
<title>Directory Tree</title>
<style>
body{font-family:sans-serif;margin:20px;}ul{list-style:none;padding-left:20px;}li{margin:5px 0;}
.folder>ul{display:block;}.fc{display:none;margin-left:20px;border:1px solid #ccc;padding:10px;white-space:pre-wrap;}
button{margin-right:8px;cursor:pointer;}
</style>
</head>
<body>
<button onclick="exAll()">Expand All</button>
<button onclick="openAll()">Open All</button>
<button onclick="clAll()">Collapse All</button>
<?php printTree($t); ?>
<script>
function toggleFolder(e){
  let c = e.parentNode.querySelector(":scope>ul");
  if(c) c.style.display = (c.style.display === 'none' ? 'block' : 'none');
}
function toggleFile(e){
  let p = e.parentNode, c = p.querySelector(".fc");
  if(!c.innerHTML.trim()){
    let x = new XMLHttpRequest();
    x.open("GET", "?file=" + encodeURIComponent(p.dataset.p));
    x.onload = () => { c.innerHTML = '<pre>' + x.responseText + '</pre>'; c.style.display = 'block'; };
    x.send();
  } else {
    c.style.display = (c.style.display === 'none' ? 'block' : 'none');
  }
}
function exAll(){
  document.querySelectorAll('.folder>ul').forEach(u => u.style.display = 'block');
}
function openAll(){
  document.querySelectorAll('.file').forEach(f => {
    let c = f.querySelector('.fc');
    if(!c.innerHTML.trim()){
      let x = new XMLHttpRequest();
      x.open("GET", "?file=" + encodeURIComponent(f.dataset.p));
      x.onload = () => { c.innerHTML = '<pre>' + x.responseText + '</pre>'; c.style.display = 'block'; };
      x.send();
    } else {
      c.style.display = 'block';
    }
  });
}
function clAll(){
  document.querySelectorAll('.folder>ul').forEach(u => u.style.display = 'none');
  document.querySelectorAll('.fc').forEach(c => c.style.display = 'none');
}
</script>
</body>
</html>
