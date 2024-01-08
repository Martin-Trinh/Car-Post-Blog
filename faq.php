<?php 
session_start();
?>
  <?php include  'partials/header.php' ?>
  <main class="container">
  <?php include 'partials/toTopBtn.php';
            include 'partials/themeBtn.php'; ?>
    <script src="javascript/faqToggle.js" defer></script>
    <div class="faq-container container">
      <h1>Frequently asked question</h1>
      <?php 
        for ($i = 0; $i < 4; $i++){
          include 'partials/question.php';  
        }
      ?>
    </div>
  </main>
  <?php include './partials/footer.php' ?>

</body>

</html>