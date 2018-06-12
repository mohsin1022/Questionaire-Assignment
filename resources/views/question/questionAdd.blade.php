@extends('layouts.app')

@section('content')
<div class="flex-center position-ref full-height container">
<div class="col-md-12 ">
        <form class="form-horizontal" id="questionair_form" action="{{route('questions.store')}}" method="POST" >
            {{csrf_field()}}
        <input type="hidden" value="{{$questionaire->id}}" name="questionaire_id" />
            <div id="step_2" >
                <h2>Add Questions</h2>
                <div id="xyz">
                    <div class="questions">
                        <div class="form-group row">
                            <label class="control-label col-sm-1" for="email">Question Type:</label>
                            <div class="col-sm-5">
                                <select id='type0' class="question_type form-control" name="question_type[]" data-id="0" >
                                    <option value="text" > Text </option>
                                    <option value="mcso" >Multiple Choice (Single Option)</option>
                                    <option value="mcmo" >Multiple Choice (Multiple Option)</option>
                                </select>
                            </div>
                        </div>
                        <div class="group">
                            <div class="form-group row">
                                <label class="control-label col-sm-1" for="question">Question:</label>
                                <div class="col-sm-5">
                                    <input type="text" required class="form-control question_text"  name="question_text[]" placeholder="Enter Question">
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="control-label col-sm-1" for="pwd">Answer:</label>
                                <div class="col-sm-5">
                                    <input type="text" required class="form-control choice0"  name="choice0[]" placeholder="Enter Answer">
                                </div>
                            </div>
                        </div>
                        <div class="error0"></div>
                        <hr>
                    </div>
                </div>
                <div class="col-sm-4">
                    <p><a  id="add_question" style="text-decoration: underline" >Add Question</a></p>
                </div>
                <div class="row">
                    <div class="col-xs-12">
                        <div class="text-left">
                            <button type="submit" class="pull-left btn btn-default">Save Questions</button>
                        </div>
                    </div>
                </div>

            </div>

        </form>
    </div>
    @stop
    @section('javascript')
    <script>
    var question_number = 0;
    $(document).on('change' , '.question_type',function(e){
        
        var $this = $(this);
        var type = $(this).val();
        var num = $(this).attr("data-id");
       // alert(num);
        switch(type){
            case 'text':
                var html =
                    '<div class="form-group row">'+
                        '<label class="control-label col-sm-1" for="question">Question:</label>'+
                        '<div class="col-sm-5">'+
                            '<input type="text" required class="form-control question_text"  name="question_text[]" placeholder="Enter Question">'+
                        '</div>'+
                    '</div>'+
                    '<div class="form-group row">'+
                        '<label class="control-label col-sm-1" for="pwd">Answer:</label>'+
                        '<div class="col-sm-5">'+
                            '<input type="text" required class="form-control choice'+num+'" name="choice'+num+'[]" placeholder="Enter Answer">'+
                        '</div>'+
                    '</div>';
                $this.closest('.form-group').next('.group').empty().append(html);
                break;
            case 'mcso':
                var html =
                    '<div class="form-group row">'+
                        '<label class="control-label col-sm-1" for="question">Question</label>'+
                        '<div class="col-sm-5">'+
                            '<input type="text" required class="form-control question_text"  name="question_text[]" placeholder="Enter Question">'+
                        '</div>'+
                    '</div>';
                    for(var i=1; i <= 3; i++){
                       html += '<div class="form-group row">'+
                            '<label class="control-label col-sm-1" for="choice">Choice </label>'+
                                '<div class="col-sm-5">'+
                                    '<input type="text" required class="form-control choice'+num+'"  name="choice'+num+'[]" placeholder="Enter Choice">'+
                                '</div>'+
                            '<label class="col-sm-2 radio-inline"><input class="correctoption'+num+'" type="radio" name="mcso'+num+'[]" value="">Correct?</label>'+
                            '<a style="margin-top:6px;text-decoration: underline" class="col-sm-2 delete_choice" >Delete Choice</a>'+
                            '</div>';
                    }
                html +=  '<a style="text-decoration: underline" class="col-lg-offset-4 add_choice"  data-question='+num+'>Add Choice</a>';
                $this.closest('.form-group').next('.group').empty().append(html);
            break;
            case 'mcmo':
                var html =
                    '<div class="form-group row">'+
                        '<label class="control-label col-sm-1" for="question">Question</label>'+
                        '<div class="col-sm-5">'+
                            '<input type="text" required class="form-control question_text" id="question" name="question_text[]" placeholder="Enter Question">'+
                        '</div>'+
                    '</div>';
                    for(var i = 1; i <= 3; i++){
                        html += '<div class="form-group row">'+
                                '<label class="control-label col-sm-1" for="choice">Choice </label>'+
                                    '<div class="col-sm-5">'+
                                        '<input type="text" required class="form-control choice'+num+'"  name="choice'+num+'[]" placeholder="Enter Choice">'+
                                    '</div>'+
                                '<label class="col-sm-2 checkbox-inline"><input class="correctoption'+num+'" type="checkbox" name="mcmo'+num+'[]" value="">Correct?</label>'+
                                '<a style="margin-top:6px;text-decoration: underline" class="col-sm-2 delete_choice" >Delete Choice</a>'+
                            '</div>';
                    }
                html +=  '<a style="text-decoration: underline" class="col-lg-offset-4 add_choice"  data-question='+num+'>Add Choice</a>';
                $this.closest('.form-group').next('.group').empty().append(html);
            break;
        }

    });
    $(document).on('click' , '#add_question',function(e){
        question_number++;
        var html =
            `<div class="form-group row">
                            <label class="control-label col-sm-1" for="email">Question Type:</label>
                            <div class="col-sm-5">
                                <select  id=type`+question_number+` class="question_type form-control" name="question_type[]" data-id="`+question_number+`">
                                    <option value="text" > Text </option>
                                    <option value="mcso" >Multiple Choice (Single Option)</option>
                                    <option value="mcmo" >Multiple Choice (Multiple Option)</option>
                                </select>
                            </div>
                        </div>
                        <div class="group">
                            <div class="form-group row">
                                <label class="control-label col-sm-1" for="question">Question:</label>
                                <div class="col-sm-5">
                                    <input type="text" required class="form-control question_text"   name="question_text[]" placeholder="Enter Question">
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="control-label col-sm-1" for="pwd">Answer:</label>
                                <div class="col-sm-5">
                                    <input type="text" required class="form-control choice`+question_number+`"  name="choice`+question_number+`[]" placeholder="Enter Answer">
                                </div>
                            </div>
                        </div>
                        <div class="error`+question_number+`"></div>
                        <hr>`;
                   
                $('.questions').append(html);
                
    });

     $(document).on('click' , '.add_choice',function(e){
        var num = $(this).attr("data-question");
        $this = $(this);
        var type = $('#type'+num).val();
        //$this.closest('.question_type').val();
        switch(type){
            case 'mcmo':
                var html = '<div class="form-group row">'+
                        '<label class="control-label col-sm-1" for="choice">Choice </label>'+
                        '<div class="col-sm-5">'+
                            '<input type="text" required class="form-control choice'+num+'"  name="choice'+num+'[]" placeholder="Enter Choice">'+
                        '</div>'+
                        '<label class="col-sm-2 checkbox-inline"><input class="correctoption'+num+'" type="checkbox" name="mcmo'+num+'[]" value="">Correct?</label>'+
                        '<a style="margin-top:6px;text-decoration: underline" class="col-sm-2 delete_choice" >Delete Choice</a>'+
                    '</div>';
                    $this.before(html);
                    break;
            
            case 'mcso':

                 var html = '<div class="form-group row">'+
                            '<label class="control-label col-sm-1" for="choice">Choice </label>'+
                                '<div class="col-sm-5">'+
                                    '<input type="text" required class="form-control choice'+num+'"  name="choice'+num+'[]" placeholder="Enter Choice">'+
                                '</div>'+
                            '<label class="col-sm-2 radio-inline"><input class="correctoption'+num+'" type="radio" name="mcso'+num+'[]" value="">Correct?</label>'+
                            '<a style="margin-top:6px;text-decoration: underline" class="col-sm-2 delete_choice" >Delete Choice</a>'+
                            '</div>';
                            $this.before(html);
                            break;
                
        }
     });
     
     $(document).on('click' , '.delete_choice',function(e){
       // $( this ).val(1);
     $(this).parent().remove();
        //console.log(val);
        //alert($(e.target).index());
     });
$(document).on('submit' , '#questionair_form',function(e){
    
  event.preventDefault();
  var flag = false;
  var question_text = $('.question_text');
  var question_type = $('.question_type');
  for(var i=0; i<question_text.length; i++){
    var correctoption = $('.correctoption'+i+':checkbox:checked');
      var showError = '';
      if(question_text[i].value==null)
      {
          showError+=`
          <p class="text-danger"> Question Text is Required </p><br />
          `;
      }
      if(question_type[i].value != 'text'){
        if(correctoption.length < 1)
        {
            showError+=`
            <p class="text-danger"> One Choice must be marked as Correct Answer </p><br />
            `;
        }
        if($('.choice'+i).length < 1)
        {
            showError+=`
            <p class="text-danger"> Kindly Add a choice to this question </p><br />
            `;
        }
      }
      if(showError!=''){
          flag= true;
          $('.error'+i).html(showError);
      }
     
      
      for(var j=0; j<correctoption.length; j++){
          if(correctoption[j].checked){
            correctoption[j].value=j;
          }
      }
  }
  if(flag){
      return;
  }
  console.log( $( this ).serializeArray() );
  $('#questionair_form').submit();
});
</script>
@stop