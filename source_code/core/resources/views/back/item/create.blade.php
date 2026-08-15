@extends('master.back')

@section('content')

<div class="container-fluid">

<!-- Page Heading -->
<div class="card mb-4">
    <div class="card-body">
        <div class="d-sm-flex align-items-center justify-content-between">
            <h3 class="mb-0 bc-title"><b>{{ __('Create Product') }}</b> </h3>
            <a class="btn btn-primary   btn-sm" href="{{route('back.item.index')}}"><i class="fas fa-chevron-left"></i> {{ __('Back') }}</a>
        </div>
    </div>
</div>

<!-- Form -->


<div class="row">
    <div class="col-lg-12">
            @include('alerts.alerts')
    </div>
</div>
<!-- Nested Row within Card Body -->
<form class="admin-form tab-form" action="{{ route('back.item.store') }}" method="POST"
                enctype="multipart/form-data">
                <input type="hidden" value="normal" name="item_type">
                @csrf
    <div class="row">

        <div class="col-lg-8">
            <div class="card">
                <div class="card-body">
                    <div class="form-group">
                        <label for="name">{{ __('Name') ?: 'Name' }} *</label>
                        <input type="text" name="name" class="form-control item-name"
                            id="name" placeholder="{{ __('Enter Name') ?: 'Enter Name' }}"
                            value="{{ old('name') }}" required >
                    </div>
                    <div class="form-group">
                        <label for="slug">{{ __('Slug') ?: 'Slug' }} *</label>
                        <input type="text" name="slug" class="form-control"
                            id="slug" placeholder="{{ __('Enter Slug') ?: 'Enter Slug' }}"
                            value="{{ old('slug') }}" required >
                    </div>
                </div>
            </div>
            <div class="card">
                <div class="card-body">
                    <div class="form-group pb-0  mb-0">
                        <label class="d-block">{{ __('Featured Image') ?: 'Featured Image' }} *</label>
                    </div>
                    <div class="form-group pb-0 pt-0 mt-0 mb-0">
                    <img class="admin-img lg" src="" >
                    </div>
                    <div class="form-group position-relative ">
                        <label class="file">
                            <input type="file"  accept="image/*"   class="upload-photo" name="photo"
                                id="file"  aria-label="File browser example">
                            <span
                                class="file-custom text-left">{{ __('Upload Image...') ?: 'Upload Image...' }}</span>
                        </label>
                        <br>
                        <span class="mt-1 text-info">{{ __('Image Size Should Be 800 x 800. or square size') }}</span>
                    </div>
                </div>
            </div>
            <div class="card">
                <div class="card-body">
                    <div class="form-group pb-0  mb-0">
                        <label>{{ __('Gallery Images') }} </label>
                    </div>
                    <div class="form-group pb-0 pt-0 mt-0 mb-0">
                        <div id="gallery-images" class="">
                            <div class="d-block gallery_image_view">
                            </div>
                        </div>
                    </div>
                    <div class="form-group position-relative ">
                        <label class="file">
                            <input type="file"  accept="image/*"  name="galleries[]" id="gallery_file" aria-label="File browser example" accept="image/*" multiple>
                            <span class="file-custom text-left">{{ __('Upload Image...') }}</span>
                        </label>
                        <br>
                        <span class="mt-1 text-info">{{ __('Image Size Should Be 800 x 800. or square size') }}</span>
                    </div>
                </div>
            </div>
            <div class="card">
                <div class="card-body">
                    <div class="form-group">
                        <label for="sort_details">{{ __('Short Description') }} *</label>
                        <textarea name="sort_details" id="sort_details"
                            class="form-control"
                            placeholder="{{ __('Short Description') }}"
                            >{{ old('sort_details') }}</textarea>
                    </div>

                    <div class="form-group">
                        <label for="details">{{ __('Description') }} *</label>
                        <textarea name="details" id="details"
                            class="form-control text-editor"
                            rows="6"
                            placeholder="{{ __('Enter Description') }}" required
                            >{{ old('details') }}</textarea>
                    </div>

                    <div class="form-group">
                        <label for="how_to_use">{{ __('How to Use') }}</label>
                        <textarea name="how_to_use" id="how_to_use"
                            class="form-control text-editor"
                            rows="6"
                            placeholder="{{ __('Enter How to Use Instructions') }}"
                            >{{ old('how_to_use') }}</textarea>
                    </div>
                </div>
            </div>
            <div class="card">
                <div class="card-body">
                    <div class="form-group mb-2">
                        <label for="features">{{ __('Key Features') }}
                            </label>
                        <input type="text" name="features" class="tags"
                            id="features"
                            placeholder="{{ __('Key Features') }}"
                            value="">
                    </div>
                    <div class="form-group mb-2">
                        <label for="tags">{{ __('Product Tags') }}
                            </label>
                        <input type="text" name="tags" class="tags"
                            id="tags"
                            placeholder="{{ __('Tags') }}"
                            value="">
                    </div>
                    <div class="form-group">
                        <label for="specification_name">{{ __('Specifications') }}</label>
                        <input type="hidden" name="is_specification" value="1">
                        <textarea name="specification_name" id="specification_name" class="form-control text-editor"
                            rows="6"
                            placeholder="{{ __('Enter Product Details (Specification)') }}"
                            >{{ old('specification_name') }}</textarea>
                    </div>
                </div>
            </div>
            <div class="card">
                <div class="card-body">
                    <div class="form-group">
                        <label class="switch-primary">
                            <input type="checkbox" class="switch switch-bootstrap status radio-check" name="is_tier_price" value="1" >
                            <span class="switch-body"></span>
                            <span class="switch-text">{{ __('Tiered/Bulk Pricing') }}</span>
                        </label>
                    </div>
                    <div id="tier-price-section" class="d-none">
                        <div class="d-flex">
                            <div class="flex-grow-1">
                                <div class="form-group">
                                    <input type="number" min="1" class="form-control"
                                        name="tier_min_qty[]"
                                        placeholder="{{ __('Minimum Quantity') }}" value="">
                                </div>
                            </div>
                            <div class="flex-grow-1">
                                <div class="form-group">
                                    <input type="number" min="0" step="0.01" class="form-control"
                                        name="tier_price[]"
                                        placeholder="{{ __('Price') }}" value="">
                                </div>
                            </div>
                            <div class="flex-btn">
                                <button type="button" class="btn btn-success add-tier-price" data-text="{{ __('Minimum Quantity') }}" data-text1="{{ __('Price') }}"> <i class="fa fa-plus"></i> </button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="card">
                <div class="card-body">
                    <div class="form-group">
                        <label for="meta_keywords">{{ __('Meta Keywords') }}
                            </label>
                        <input type="text" name="meta_keywords" class="tags"
                            id="meta_keywords"
                            placeholder="{{ __('Enter Meta Keywords') }}"
                            value="">
                    </div>

                    <div class="form-group">
                        <label
                            for="meta_description">{{ __('Meta Description') }}
                            </label>
                        <textarea name="meta_description" id="meta_description"
                            class="form-control" rows="5"
                            placeholder="{{ __('Enter Meta Description') }}"
                        >{{ old('meta_description') }}</textarea>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-lg-4">
            <div class="card">
                <div class="card-body">
                    <input type="hidden" class="check_button" name="is_button" value="0">
                    <button type="submit" class="btn btn-secondary mr-2" name="status" value="1">{{ __('Save') }}</button>
                    <button type="submit" class="btn btn-info save__edit mr-2" name="status" value="1">{{ __('Save & Edit') }}</button>
                    <button type="submit" class="btn btn-warning mr-2" name="status" value="0">{{ __('Save Draft') }}</button>
                    <a href="{{ route('back.item.index') }}" class="btn btn-danger btn-cancel">{{ __('Cancel') }}</a>
                </div>
            </div>
            <div class="card">
                <div class="card-body">
                    <div class="form-group">
                        <label for="discount_price">{{ __('Current Price') }}
                            *</label>
                        <div class="input-group mb-3">
                            <div class="input-group-prepend">
                                <span
                                    class="input-group-text">{{ PriceHelper::adminCurrency() }}</span>
                            </div>
                            <input type="text" id="discount_price"
                                name="discount_price" class="form-control"
                                placeholder="{{ __('Enter Current Price') }}"
                                min="1" step="0.1"
                                value="{{ old('discount_price') }}" >
                        </div>
                    </div>

                    <div class="form-group">
                        <label for="previous_price">{{ __('Previous Price') }}
                            </label>
                        <div class="input-group mb-3">
                            <div class="input-group-prepend">
                                <span
                                    class="input-group-text">{{ $curr->sign }}</span>
                            </div>
                            <input type="text" id="previous_price"
                                name="previous_price" class="form-control"
                                placeholder="{{ __('Enter Previous Price') }}"
                                min="1" step="0.1"
                                value="{{ old('previous_price') }}" >
                        </div>
                    </div>
                </div>
            </div>
            <div class="card">
                <div class="card-body">

                    <div class="form-group">
                        <label for="category_id">{{ __('Select Category') }} *</label>
                        <select name="category_id" id="category_id" data-href="{{route('back.get.subcategory')}}" class="form-control" required >
                            <option value="" selected>{{__('Select One')}}</option>
                            @foreach(DB::table('categories')->whereStatus(1)->get() as $cat)
                            <option value="{{ $cat->id }}">{{ $cat->name }}</option>
                            @endforeach
                        </select>
                    </div>

                    <div class="form-group">
                        <label for="subcategory_id">{{ __('Select Sub Category') }} </label>
                        <select name="subcategory_id" id="subcategory_id" data-href="{{route('back.get.childcategory')}}" class="form-control">
                            <option value="">{{__('Select One')}}</option>
                        </select>
                    </div>

                    <div class="form-group">
                        <label for="childcategory_id">{{ __('Select Child Category') }} </label>
                        <select name="childcategory_id" id="childcategory_id" class="form-control">
                            <option value="">{{__('Select One')}}</option>
                        </select>
                    </div>

                    <div class="form-group">
                        <label for="brand_id">{{ __('Select Brand') }} </label>
                        <select name="brand_id" id="brand_id" class="form-control" >
                            <option value="" selected>{{__('Select Brand')}}</option>
                            @foreach(DB::table('brands')->whereStatus(1)->get() as $brand)
                            <option value="{{ $brand->id }}">{{ $brand->name }}</option>
                            @endforeach
                        </select>
                    </div>
                </div>
            </div>
            <div class="card">
                <div class="card-body">
                    <div class="form-group">
                        <label for="stock">{{ __('Total in stock') }}</label>
                        <div class="input-group mb-3">
                            <input type="number" id="stock"
                                name="stock" class="form-control"
                                placeholder="{{ __('Total in stock') }}" value="{{ old('stock') }}" >
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="tax_id">{{ __('Select Tax') }}</label>
                        <select name="tax_id" id="tax_id" class="form-control">
                            <option value="">{{__('Select One')}}</option>
                            @foreach(DB::table('taxes')->whereStatus(1)->get() as $tax)
                            <option value="{{ $tax->id }}">{{ $tax->name }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="sku">{{ __('SKU') }} *</label>
                        <input type="text" name="sku" class="form-control"
                            id="sku" placeholder="{{ __('Enter SKU') }}"
                            value="{{Str::random(10)}}" required >
                    </div>
                    <div class="form-group">
                        <label for="video">{{ __('Video Link') }} </label>
                        <input type="text" name="video" class="form-control"
                            id="video" placeholder="{{ __('Enter Video Link') }}"
                            value="{{ old('video') }}">
                    </div>
                </div>
            </div>
        </div>

    </div>
</form>


</div>

@endsection

@section('scripts')
<script>
document.querySelectorAll('.admin-form button[type="submit"]').forEach(button => {
    button.addEventListener('click', function(e) {
        const form = this.closest('form');
        if (!form.checkValidity()) {
            alert('{{ __("Please fill out all required fields.") }}');
        } else {
            localStorage.removeItem('product_draft_data_new');
        }
    });
});
if(document.querySelector('.btn-cancel')){
    document.querySelector('.btn-cancel').addEventListener('click', function() {
        localStorage.removeItem('product_draft_data_new');
    });
}

$(document).ready(function() {
    const draftKey = 'product_draft_data_new';
    let savedDraft = localStorage.getItem(draftKey);
    if (savedDraft) {
        if (confirm("{{ __('An unsaved draft was found. Do you want to restore it?') }}")) {
            let data = JSON.parse(savedDraft);
            for (let name in data) {
                let input = $('[name="'+name+'"]');
                if (input.length > 0) {
                    if (input.is(':checkbox') || input.is(':radio')) {
                        input.prop('checked', data[name] == input.val());
                    } else if (input.hasClass('text-editor')) {
                        input.val(data[name]);
                        setTimeout(() => input.summernote('code', data[name]), 500);
                    } else {
                        input.val(data[name]);
                    }
                }
            }
        } else {
            localStorage.removeItem(draftKey);
        }
    }
    
    setInterval(function() {
        $('.text-editor').each(function() {
            if ($(this).next().hasClass('note-editor')) {
                $(this).val($(this).summernote('code'));
            }
        });
        let formData = {};
        $('.admin-form').serializeArray().forEach(function(item) {
            formData[item.name] = item.value;
        });
        localStorage.setItem(draftKey, JSON.stringify(formData));
    }, 5000);
});
</script>
@endsection
