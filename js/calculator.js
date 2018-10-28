// CUSTOM SCRIPTS

$(document).ready(function(){
  //process the total mark first

  var attendance = Number(document.getElementById('attendance').value);
  var firsttest = Number(document.getElementById('firsttest').value);
  var secondtest = Number(document.getElementById('secondtest').value);
  var exam_score = Number(document.getElementById('exam_score').value);
  var total = document.getElementById('total');
  total.value = attendance + firsttest + secondtest + exam_score;

  //process the grade
  var grade = document.getElementById('grade');
  if(total.value >= 70 && total.value <= 100){
    grade.value = 'A';
  }
  if(total.value >= 60 && total.value <= 69){
    grade.value = 'B';
  }
  if(total.value >= 50 && total.value <= 59){
    grade.value = 'C';
  }
  if(total.value >= 45 && total.value <= 49){
    grade.value = 'D';
  }
  if(total.value >= 40 && total.value <= 44){
    grade.value = 'E';
  }
  if(total.value >= 0 && total.value <= 39){
    grade.value = 'F';
  }
});
