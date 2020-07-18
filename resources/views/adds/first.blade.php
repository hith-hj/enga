@extends('layouts.app2')
@section('content')
    <div class="page-wrapper bg-gra-02 p-t-25 p-b-5 font-poppins animated slideInRight" >
        <div class="wrapper wrapper--w680" style="margin:0 auto;">
            <div class="card card-4">
                <div class="card-body">
                    <h2 class="title" style="border-bottom:1px solid #d2cdcd;margin-bottom:10px;">Lets Begin with </h2>
                    <form action="/getgenderAge" method="POST" >
                            <div class="row row-space">
                                <div class="col-2 input-group">
                                    <label class="label">Gender</label>
                                    <div class="p-t-10">
                                        <label class="radio-container m-r-45">Male
                                            <input type="radio" checked="checked" name="gender" value="male" >
                                            <span class="checkmark"></span>
                                        </label>
                                        <label class="radio-container">Female
                                            <input type="radio" name="gender" value="female" >
                                            <span class="checkmark"></span>
                                        </label>
                                    </div>
                                </div>
                                <div class="col-2">
                                    <div class="input-group">
                                        <label class="label">Age</label>
                                        <input class="input--style-4 " type="number" inputmode="numeric" name="age" min="18" required >
                                    </div>
                                </div>
                                <div class="col-2">
                                    <div class="input-group">
                                        <label class="label">district</label>
                                        <div class="rs-select2 js-select-simple select--no-search">
                                            <select required name="district" >
                                                <option disabled="disabled" selected="selected">Choose option</option>
                                                <option value="Damascus">Damascus</option>
                                                <option value="Aleppo">Aleppo</option>
                                                <option value="Lattakia">Lattakia</option>
                                                <option value="Homs">Homs</option>
                                                <option value="Tartos">Tartos</option>
                                                <option value="Hama">Hama</option>
                                                <option value="Daraa">Daraa</option>
                                                <option value="sweida">sweida</option>
                                            </select>
                                            <div class="select-dropdown"></div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-2">
                                    <div class="input-group">
                                        <label class="label">Edutcation</label>
                                        <div class="rs-select2 js-select-simple select--no-search">
                                            <select required name="education" >
                                                <option disabled="disabled" selected="selected">Choose option</option>
                                                <option value="first degree">first degree</option>
                                                <option value="second degree">second degree</option>
                                                <option value="third degree">third degree</option>
                                                <option value="forth degree">forth degree</option>
                                                <option value="fifth degree">fifth degree</option>
                                            </select>
                                            <div class="select-dropdown"></div>
                                        </div>
                                    </div>
                                </div> 
                                <div class="col-2">
                                    <div class="input-group">
                                        <label class="label">Phone Number</label>
                                        <input class="input--style-4" type="text" name="phone" inputmode="numeric" pattern="(09)\d{8}" required>
                                    </div>
                                </div>
                                <div class="col-2">
                                    <div class="input-group">
                                        <label class="label">social status</label>
                                        <div class="rs-select2 js-select-simple select--no-search">
                                            <select required name="socialStatus">
                                                <option disabled="disabled" selected="selected">Choose option</option>
                                                <option value="single" >single</option>
                                                <option value="divorsed" >divorsed</option>
                                                <option value="complicated" >complicated</option>
                                            </select>
                                            <div class="select-dropdown"></div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <hr>
                            <div class="p-t-15">
                                <button class="btn btn--radius-2 btn--blue col-12" type="submit">Next <i class="fa fa-chevron-right m-1"></i></button>
                            </div>
                        @csrf
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
