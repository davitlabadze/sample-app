<div class="card">
    <div class="card-header">create category</div>

    <div class="card-body">
        <form method="POST" onsubmit="createCategory(event)" action="{{ route('admin.category.store') }}">
          

            <div class="form-group row">
                <label for="email" class="col-md-4 col-form-label text-md-right">Enter Category Name</label>

                <div class="col-md-6">
                    <input type="text" id="category-name" class="form-control @error('name') is-invalid @enderror" name="name" 
                    value="{{ old('name') }}" required autofocus>

                    @error('name')
                        <span class="invalid-feedback" role="alert"></span>
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                </div>
            </div>

            

           

            <div class="form-group row mb-0">
                <div class="col-md-4 offset-md-4">
                    <button type="submit" id="category-submit-button" class="btn btn-primary">
                        Create Category
                    </button>
                    
                </div>

                <div class="col-md-0 offset-md-0">
                    <p id="msg" class="btn btn-success" style="display:none; cursor: default; ">
    
                    </p>
                </div>
                
                
            </div>
        </form>
    </div>
</div>

<script>
    function createCategory(e) {
        e.preventDefault();
        var serializedForm = $(e.target).serialize()

        $.ajax({
            url: "{{ route('admin.category.store') }}?" + serializedForm,
            type: 'POST',
            data: {},
            success: function(data) {
                if (data.success) {
                   
                    //animation
                    $('#msg').html(data.message).fadeIn('slow');
                    $('#msg').delay(1000).fadeOut('slow');
                   
                    $('#category-name').val('');
                    refreshCategoryTable();
                }
            },
            error: function() {

            },
        });
    }

</script>














