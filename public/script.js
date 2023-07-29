// FUNCOES BASICAS
function O(i){
    //Substitui o getElementById por O.
    //return document.getElementById(i);
    return typeof i == 'object' ? i : document.getElementById(i);
}
function S(i){
    //Util para selecionar o CSS interno dos elementos.
    return O(i).style;
}
function C(i){
    //Retorna array de elementos com o nome da classe passada para a funçao.
    return document.getElementsByClassName(i);
}
// FUNCOES DA PAGINA EM GERAL


// VARIAVEIS GLOBAIS

let isDark = false;

// WINDOW

window.onload = () => {
    //Botao Noturno
    O('bLuz').onclick = () => {
        if(isDark){
            S('mainMain').backgroundColor = '#FFFFFF';
            S('suaLista').color = '#000000';
            S('sobreNos').color = '#000000';
            isDark = false;
        }
        else{
            S('mainMain').backgroundColor = '#161616';
            S('suaLista').color = '#FFFFFF';
            S('sobreNos').color = '#FFFFFF';
            isDark = true;
        }
    };
    //Botao Donate:
    O('bDonate').onclick = () => {
        document.getElementsByClassName('boxLista')[0].innerHTML = `
        <section style="background-color: #101010; color: white; margin: 10px; padding: 5px; border-radius: 6px;">
            <p> Aceitamos doações, mas não é necessário pagar para utilizar a página!</p>
            Doe aqui: <a style="text-decoration: none; color: rgb(255,100,255);" href="#">DOAR</a>
        </section>
        `;
    };


};