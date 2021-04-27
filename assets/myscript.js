// ================================= Select ==========================================================================
var select_html = "";
var text = "";
for (let i = 0; i < 24; i++) {
    if (i.toString().length == 1) {
        text = "0" + i;
        if (text == "00") {
            select_html += '<option value="' + text + '" selected>' + text + '</option>';
        } else {
            select_html += '<option value="' + text + '">' + text + '</option>';
        }
        
    } else {
        text = i;
        select_html += '<option value="' + text + '">' + text + '</option>';
    }
}
document.getElementById('select1').innerHTML = select_html;
document.getElementById('select2').innerHTML = select_html;

