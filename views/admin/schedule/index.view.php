<?php include 'views/partials/head.php'; ?>

<h1>Schedules by Faculty / Room / Section</h1>

<a href="/admin/schedule/create" class="btn btn-primary" style="margin-bottom: 1rem;">Create Schedule</a>

<!-- Filter form -->
<form method="GET" action="/admin/schedules" style="margin-bottom:1rem;">
  <label for="viewType">View By:</label>
  <select name="viewType" id="viewType" required>
    <option value="">-- Choose One --</option>
    <option value="faculty" <?= (($_GET['viewType'] ?? '') === 'faculty') ? 'selected' : '' ?>>Faculty</option>
    <option value="room"    <?= (($_GET['viewType'] ?? '') === 'room')    ? 'selected' : '' ?>>Room</option>
    <option value="section" <?= (($_GET['viewType'] ?? '') === 'section') ? 'selected' : '' ?>>Section</option>
  </select>
  <!-- Autocomplete text box -->
  <input type="text" id="autocompleteInput" placeholder="Search..." />
  <input type="hidden" name="selectedId" id="hiddenId" value="<?= htmlspecialchars($_GET['selectedId'] ?? '') ?>" />
  <button type="submit">Display</button>
</form>

<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="https://code.jquery.com/ui/1.13.2/jquery-ui.min.js"></script>
<script>
const facultiesData = <?= json_encode($faculties) ?>;
const roomsData     = <?= json_encode($rooms) ?>;
const sectionsData  = <?= json_encode($sections) ?>;
let currentData     = [];

function updateAutocomplete(type) {
  if (type === 'faculty') {
    currentData = facultiesData.map(f => ({
      label: f.lastname + ', ' + f.firstname,
      value: f.id
    }));
  } else if (type === 'room') {
    currentData = roomsData.map(r => ({
      label: r.name,
      value: r.id
    }));
  } else if (type === 'section') {
    currentData = sectionsData.map(s => ({
      label: s.section,
      value: s.id
    }));
  } else {
    currentData = [];
  }
  $('#autocompleteInput').autocomplete('option', 'source', currentData);
}

$('#autocompleteInput').autocomplete({
  minLength: 0,
  source: currentData,
  select: function(event, ui) {
    event.preventDefault();
    $('#autocompleteInput').val(ui.item.label);
    $('#hiddenId').val(ui.item.value);
  },
  focus: function(event, ui) {
    event.preventDefault();
    $('#autocompleteInput').val(ui.item.label);
  }
});

$('#viewType').on('change', function() {
  $('#autocompleteInput').val('');
  $('#hiddenId').val('');
  updateAutocomplete(this.value);
});

$(document).ready(function() {
  const val = $('#viewType').val();
  if (val) {
    updateAutocomplete(val);
    const storedId = $('#hiddenId').val();
    if (storedId) {
      const found = currentData.find(x => String(x.value) === storedId);
      if (found) {
        $('#autocompleteInput').val(found.label);
      }
    }
  }
});
</script>

<?php
$days = ['Mon','Tue','Wed','Thu','Fri'];
$indexed = [];
foreach ($schedules as $s) {
  // e.g. $indexed['Mon']['08:00:00'] = [schedule row]
  $indexed[$s['day']][$s['start_time']] = $s;
}
$timeSlots = [];
$start = strtotime('07:30:00');
$end   = strtotime('17:00:00');
while ($start < $end) {
  $timeSlots[] = date('H:i:s', $start);
  $start += 1800;
}
?>

<div style="margin-top:1rem;overflow-x:auto;">
  <table border="1" cellpadding="5" cellspacing="0">
    <thead>
      <tr>
        <th>Time</th>
        <?php foreach ($days as $d): ?>
          <th><?= $d ?></th>
        <?php endforeach; ?>
      </tr>
    </thead>
    <tbody>
      <?php foreach ($timeSlots as $ts): ?>
        <tr>
          <td><?= date('g:i a', strtotime($ts)) ?></td>
          <?php foreach ($days as $d): ?>
            <td style="min-width:150px;vertical-align:top;">
              <?php if (!empty($indexed[$d][$ts])): ?>
                <?php
                  $row = $indexed[$d][$ts];
                  $endT = date('g:i a', strtotime($row['end_time']));
                  $subj = ($row['subject_code'] ?: '') . ' ' . ($row['subject_desc'] ?: '');
                  $fac  = $row['faculty_lname'] . ', ' . $row['faculty_fname'];
                  $rm   = $row['room_name'];
                  $sec  = $row['section_name'];
                ?>
                <strong><?= htmlspecialchars($subj) ?></strong><br>
                <?= htmlspecialchars($fac) ?><br>
                Room: <?= htmlspecialchars($rm) ?><br>
                Section: <?= htmlspecialchars($sec) ?><br>
                <?= date('g:i a', strtotime($row['start_time'])) ?> - <?= $endT ?>
              <?php endif; ?>
            </td>
          <?php endforeach; ?>
        </tr>
      <?php endforeach; ?>
    </tbody>
  </table>
</div>

<?php include 'views/partials/foot.php'; ?>
