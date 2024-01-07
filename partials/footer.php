<footer class="container">
      <div class="footer-about">
        <h2 class="page-logo footer-logo">Car Blog</h2>
        <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Incidunt quae, ipsum aliquid optio veniam sed perspiciatis laborum dolore rerum? Impedit quis, provident est, veritatis similique natus rerum blanditiis eum recusandae accusamus</p>
      </div>
      <div class="faq-footer">
        <h2>FAQ</h2>
        <ul>
          <li><a href="faq.php">How to write an article?</a></li>
          <li><a href="faq.php">Who can see my post?</a></li>
          <li><a href="faq.php">Who can edit my post?</a></li>
          <li><a href="faq.php">Rules</a></li>
        </ul>
      </div>
      <div class="my-account-footer">
        <h2>Categories</h2>
        <ul>
          <li><a href="../category.php?category=News">News</a></li>
          <li><a href="../category.php?category=Interesting facts">Interesting facts</a></li>
          <li><a href="../category.php?category=Reviews">Reviews</a></li>
          <li><a href="../category.php?category=Technology">Technology</a></li>
        </ul>
      </div>
      <div class="my-account-footer">
        <h2>My account</h2>
        <ul>
          <?php if(isset($_SESSION['user'])) : ?>
            <li><a href="../profile.php?username=<?= $_SESSION['user']['username']?>"><?= $_SESSION['user']['username']?></a></li>
            <?php else: ?>
              <li><a href="../login.php">My profile</a></li>
          <?php endif ?>
        </ul>
      </div>
      <!-- <div class="contact-admin-footer">
        <h2>Follow us</h2>
        <div class="footer-contact">
          <a href="" target="_blank"><i class="fa-brands fa-facebook"></i></a>
          <a href="" target="_blank"><i class="fa-brands fa-instagram"></i></a>
          <a href="" target="_blank"><i class="fa-brands fa-x-twitter"></i></a>
        </div>
      </div> -->
      <div class="copyright-footer">
        <p>Copyright &copy; 2023 Car Blog. All rights reserved.</p>
      </div>
    </footer>