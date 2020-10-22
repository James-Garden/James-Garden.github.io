function changeText() {
  let x = document.getElementById('testP').innerHTML;
  if (x=='test1') {
    document.getElementById('testP').innerHTML = 'test2';
  } else {
    document.getElementById('testP').innerHTML = 'test1';
  }
}

var testPress = document.getElementById('testBtn');
testPress.addEventListener('click',changeText);
