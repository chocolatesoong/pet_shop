<link rel="stylesheet" href="<?= base_url('assets/css/sweetalert2.min.css') ?>" type="text/css" />
<script src="<?= base_url('assets/js/sweetalert2.min.js') ?>"></script>
<script>
  $(document).ready(function() {
    <?php if (session()->has('warning')) : ?>
      Swal.fire(
        'Ops!',
        '<?= session('warning') ?>',
        'warning'
      )
    <?php endif; ?>
    <?php if (session()->getFlashdata('error')) : ?>
      Swal.fire({
        icon: 'error',
        title: 'Ops!',
        text: '<?= session()->getFlashdata('error'); ?>',
      })
    <?php endif; ?>
    <?php if (session()->getFlashdata('success')) : ?>
      Swal.fire({
        icon: 'success',
        title: 'Done!',
        text: '<?= session()->getFlashdata('success'); ?>',
      })
    <?php endif; ?>
  });
</script>
<script>
  <?php if (session()->has('info')) : ?>
    $(document).ready(function() {
      Swal.fire(
        'Hi!',
        '<?= session('info') ?>',
        'info'
      )
    });
  <?php endif; ?>
  <?php if (session()->has('success')) : ?>
    $(document).ready(function() {
      Swal.fire(
        'Done!',
        '<?= session('success') ?>',
        'success'
      )
    });
  <?php endif; ?>
  <?php if (session()->has('errors')) : ?>
    $(document).ready(function() {
      Swal.fire(
        'Ops!',
        '<?= implode('.', session('errors')) . "<br>" . session()->getFlashdata('error'); ?>', //if setFlashdata('error', string) not write in controller, getFlashdata('error') not added.
        'error'
      )
    });
  <?php endif; ?>
</script>