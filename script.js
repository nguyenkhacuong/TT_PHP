    var manche = document.getElementById("manChan");

    function addManche(el, classname){
    el.setAttribute('class', classname);
    }
    function delManche(el, classname){
    el.setAttribute('class', classname)
    }
    function openAny(idtab){
    document.getElementById(idtab).style.display='block';
    addManche(manche, 'manChan');
    }

    function closeAny(idtab){
    document.getElementById(idtab).style.display='none';
    addManche(manche, '');
    }
    function openEdit(idtab){
        document.getElementById(idtab).style.display='block';
        addManche(manche, 'manChan2');
    }
    function closeEdit(idtab){
        document.getElementById(idtab).style.display='none';
        addManche(manche, 'manChan');
    }
