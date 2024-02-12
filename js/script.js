async function ejecutarScriptPHP(archivo) {
    return new Promise((resolve, reject) => {
        fetch(archivo)
            .then(response => response.text())
            .then(data => {
                console.log(data);
                resolve();
            })
            .catch(error => {
                console.error('Error al llamar al script PHP:', error);
                reject(error);
            });
    });
}

// Llamar a los scripts PHP secuencialmente
async function ejecutarScriptsSecuencialmente() {
    try {
        if (!localStorage.getItem('scriptEjecutado')) {
            await ejecutarScriptPHP('conectarycrearlaDB.php');
            await ejecutarScriptPHP('creartablasenlaDB.php');
            await ejecutarScriptPHP('meteregistro.php');
            localStorage.setItem('scriptEjecutado', 'true');
        }
    } catch (error) {
        console.error('Error al ejecutar scripts:', error);
    }
}

// Llamar a la función para ejecutar los scripts secuencialmente
window.onload = ejecutarScriptsSecuencialmente;
