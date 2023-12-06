  <?php include  'partials/header.php' ?>
  <main class="container">
  <?php include 'partials/toTopBtn.php';
            include 'partials/themeBtn.php'; ?>
    <script src="javascript/faqToggle.js" defer></script>
    <div class="faq-container container">
      <h2>Frequently asked question</h2>
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