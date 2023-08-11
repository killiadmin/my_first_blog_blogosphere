<div class="container mt-4">
    <h1>Write your post</h1>
    <form action="post&status=new" method="post">
        <div class="form-group">
            <label for="title">Title :</label>
            <input type="text" class="form-control" id="title" name="title" required>
        </div>

        <div class="form-group">
            <label for="chapo">Chapo :</label>
            <textarea class="form-control" id="chapo" name="chapo" rows="4" required></textarea>
        </div>

        <div class="form-group">
            <label for="content">Content :</label>
            <textarea class="form-control" id="content" name="content" rows="10" required></textarea>
        </div>
        <div class="d-flex flex-row-reverse m-3">
            <button type="submit" class="btn btn-secondary">Send your post</button>
        </div>
    </form>
</div>



