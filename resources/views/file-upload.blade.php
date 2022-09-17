<form action="{{ url('upload-to-api') }}" method="POST" enctype="multipart/form-data">
    @csrf
    <label>Image File</label>
    <input type="file" name="file">
    <label>Name</label>
    <input type="text" name="name">
    <button type="submit">Submit</button>
</form>