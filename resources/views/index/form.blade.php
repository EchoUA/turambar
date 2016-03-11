<input type="hidden" name="_token" value="{{ csrf_token() }}">

<div class="form-group">
    <label class="col-sm-2 control-label" for="name">Name</label>
    <div class="col-sm-10">
        <input id="name" type="text" name="name" class="form-control" value="{{ isset($movies->name) ? $movies->name : old('name') }}" required>
    </div>
</div>

<div class="form-group">
    <label class="col-sm-2 control-label" for="desc">Description</label>
    <div class="col-sm-10">
        <textarea name="desc" id="desc" cols="30" rows="10" class="form-control" required>{{ isset($movies->desc) ? $movies->desc : old('desc') }}</textarea>
    </div>
</div>

<div class="form-group">
    <label class="col-sm-2 control-label" for="year">Year</label>
    <div class="col-sm-10">
        <input id="year" type="number" name="year" class="form-control" value="{{ isset($movies->year) ? $movies->year : old('year') }}" required>
    </div>
</div>

<div class="form-group">
    <div class="col-sm-offset-2 col-sm-10">
        <label class="radio-inline col-sm-2">
            <input type="radio" name="isActive" value="1" @if(isset($movies->isActive) && $movies->isActive) checked @endif> Active
        </label>
        <label class="radio-inline col-sm-2">
            <input type="radio" name="isActive" value="0" @if(isset($movies->isActive) && ! $movies->isActive) checked @endif> Inactive
        </label>
    </div>
</div>

<div class="form-group">
    <div class="col-sm-offset-2 col-sm-10">
        <input type="submit" class="btn btn-success" value="Submit">
    </div>
</div>