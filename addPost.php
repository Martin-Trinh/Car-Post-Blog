    <?php include 'partials/header.php' ?>
    
    <main class="container">
    <?php include 'partials/toTopBtn.php';
            include 'partials/themeBtn.php'; ?>
        <script src="javascript/validationWritePost.js" defer></script>
        <script src="javascript/validation.js" defer></script>
        <div class="container form-container add-post-container">
            <h2>Write an article</h2>
            <form action="/" method="POST" id="form" enctype="multipart/form-data">
                <div class="form-field">
                    <label for="title-post">Title</label>
                    <input type="text" name="post-title" placeholder="title-post" id="title-post" autocomplete="off" >
                    <i class="fa-solid fa-circle-check"></i>
                    <i class="fa-solid fa-circle-exclamation"></i>
                    <small>Error message</small>
                </div>
                <div class="form-field">
                    <label for="category">Choose category</label>
                    <select name="category" id="category">
                        <option value="">-- Select category -- </option>
                        <option value="tech">Technology</option>
                        <option value="news">News</option>
                        <option value="review">Reviews</option>
                        <option value="facts">Interesting facts</option>
                    </select>
                    <small>Error message</small>
                </div>
                <div class="form-field">
                    <label for="category-select">Article body</label>
                    <textarea name="article-body" id="article-body" rows="10" placeholder="Write your article" ></textarea>
                    <i class="fa-solid fa-circle-check"></i>
                    <i class="fa-solid fa-circle-exclamation"></i>
                    <small>Error message</small>
                </div>
                <div class="form-field">
                    <label for="thumbnail">Add Thumbnail</label>
                    <input type="file" name="thumbnail" id="thumbnail">
                    <small>Error message</small>
                </div>
                <button type="submit">Publish</button>
            </form>
        </div>
    </main>
    <?php include './partials/footer.php' ?>

</body>
</html>