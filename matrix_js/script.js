let a,b,c,d,e,f,g,h,i;
let matrix_a;
let matrix_b;
function matrix1() {
    a = document.getElementById('a').value;
    b = document.getElementById('b').value;
    c = document.getElementById('c').value;
    d = document.getElementById('d').value;
    e = document.getElementById('e').value;
    f = document.getElementById('f').value;
    matrix_a = math.matrix([[a, b, c], [d,e,f]]);
    console.log(matrix_a);
}
function matrix2() {
    a1 = document.getElementById('a1').value;
    b1 = document.getElementById('b1').value;
    c1 = document.getElementById('c1').value;
    d1 = document.getElementById('d1').value;
    e1 = document.getElementById('e1').value;
    f1 = document.getElementById('f1').value;
    g1 = document.getElementById('g1').value;
    h1 = document.getElementById('h1').value;
    i1 = document.getElementById('i1').value;
    matrix_b = math.matrix([[a1,b1,c1],[d1,e1,f1],[g1,h1,i1]]);
    console.log(matrix_b);
}
function matrix_szorzas() {
    const szorzas = math.multiply(matrix_a,matrix_b);
    document.getElementById("szorzas").innerHTML = '<p>A mátrix szorzásának eredménye: '+szorzas+'</p>';
}