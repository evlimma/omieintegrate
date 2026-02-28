const fs = require("fs");
const readline = require("readline");
const { execSync } = require("child_process");

const VERSION_FILE = "VERSION";

function getCurrentVersion() {
    if (!fs.existsSync(VERSION_FILE)) return "0.0.0";
    return fs.readFileSync(VERSION_FILE, "utf-8").trim();
}

function setNewVersion(version) {
    fs.writeFileSync(VERSION_FILE, version);
}

function bumpVersion(current, type) {
    let [major, minor, patch] = current.split(".").map(Number);

    switch (type) {
        case "major":
            major++;
            minor = 0;
            patch = 0;
            break;
        case "minor":
            minor++;
            patch = 0;
            break;
        case "patch":
        default:
            patch++;
    }

    return `${major}.${minor}.${patch}`;
}

const bumpType = process.argv[2] || "patch";
const currentVersion = getCurrentVersion();
const newVersion = bumpVersion(currentVersion, bumpType);

console.log(`Versão atual: ${currentVersion}`);
console.log(`Nova versão:  ${newVersion}`);

const rl = readline.createInterface({
    input: process.stdin,
    output: process.stdout,
});

rl.question("Confirmar e aplicar? [s/n]: ", (answer) => {
    if (/^s$/i.test(answer.trim())) {
        setNewVersion(newVersion);
        try {
            execSync("git add .", { stdio: "inherit" });
            execSync(`git commit -m "Versão ${newVersion}"`, { stdio: "inherit" });
            execSync(`git tag -a ${newVersion} -m "Versão ${newVersion}"`, { stdio: "inherit" });
            execSync("git push", { stdio: "inherit" });
            execSync("git push --tags", { stdio: "inherit" });
            console.log(`✅ Versão ${newVersion} publicada com sucesso!`);
        } catch (err) {
            console.error("❌ Erro ao executar comandos Git:", err.message);
        }
    } else {
        console.log("❌ Operação cancelada.");
    }
    rl.close();
});