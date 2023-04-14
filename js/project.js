const scene = new THREE.Scene();
const camera = new THREE.PerspectiveCamera(75, window.innerWidth / window.innerHeight, 0.1, 1000);

const renderer = new THREE.WebGLRenderer();
renderer.setSize(window.innerWidth, window.innerHeight);
document.body.appendChild(renderer.domElement);

const sphereGeometry1 = new THREE.SphereGeometry(0.8, 32, 32);
const sphereGeometry2 = new THREE.SphereGeometry(1, 32, 32);
const sphereGeometry3 = new THREE.SphereGeometry(2, 32, 32);

const physTexture = new THREE.TextureLoader().load('images/galaxy.jpeg');
const medTexture = new THREE.TextureLoader().load('images/cometes.jpeg');
const ecoTexture = new THREE.TextureLoader().load('images/earth.jpg');

const physMaterial = new THREE.MeshBasicMaterial({ map: physTexture });
const medMaterial = new THREE.MeshBasicMaterial({ map: medTexture });
const ecoMaterial = new THREE.MeshBasicMaterial({ map: ecoTexture });

const physSphere = new THREE.Mesh(sphereGeometry1, physMaterial);
const medSphere = new THREE.Mesh(sphereGeometry2, medMaterial);
const ecoSphere = new THREE.Mesh(sphereGeometry3, ecoMaterial);

physSphere.position.set(10, 7, -10);
medSphere.position.set(-1, -9, -8);
ecoSphere.position.set(1, -1, 0);

scene.add(physSphere);
scene.add(medSphere);
scene.add(ecoSphere);

// physSphere.userData.url = "https://physics.example.com";
// medSphere.userData.url = "https://medicine.example.com";
// ecoSphere.userData.url = "https://economy.example.com";

function createCurvedLineBetweenObjects(object1, object2, segments, color, yOffset) {
    const points = [];
    for (let i = 0; i <= segments; i++) {
        points.push(new THREE.Vector3());
    }

    const curveGeometry = new THREE.BufferGeometry().setFromPoints(points);
    const curveMaterial = new THREE.LineBasicMaterial({ color: color });
    const line = new THREE.Line(curveGeometry, curveMaterial);

    line.userData.update = function () {
        const start = object1.position.clone();
        const end = object2.position.clone();
        const mid = start.clone().lerp(end, 0.5);
        const controlPoint = mid.clone().add(new THREE.Vector3(0, (start.distanceTo(end) / 2) * yOffset, 0));

        for (let i = 0; i <= segments; i++) {
            const t = i / segments;
            const ab = new THREE.Vector3().lerpVectors(start, controlPoint, t);
            const bc = new THREE.Vector3().lerpVectors(controlPoint, end, t);
            const point = new THREE.Vector3().lerpVectors(ab, bc, t);

            const waveHeight = 0.1 * Math.sin(i / 5 + performance.now() * 0.001);
            points[i].copy(point).add(new THREE.Vector3(0, waveHeight, 0));
        }

        curveGeometry.setFromPoints(points);
    };

    return line;
}

const physEcoLine1 = createCurvedLineBetweenObjects(physSphere, medSphere, 50, 0xffffff, -1);
const physMedLine2 = createCurvedLineBetweenObjects(physSphere, medSphere, 50, 0xffffff, 1);
const ecoPhysLine2 = createCurvedLineBetweenObjects(ecoSphere, physSphere, 50, 0xffffff, 1);

scene.add(physEcoLine1);
scene.add(physMedLine2);
scene.add(ecoPhysLine2);

camera.position.z = 10;

function animate() {
    requestAnimationFrame(animate);

    physSphere.rotation.y += 0.001;
    medSphere.rotation.y += 0.001;
    ecoSphere.rotation.y += 0.001;

    physEcoLine1.userData.update();
    physMedLine2.userData.update();
    ecoPhysLine2.userData.update();

    renderer.render(scene, camera);
}

animate();

const raycaster = new THREE.Raycaster();
const mouse = new THREE.Vector2();

function onDocumentMouseDown(event) {
    event.preventDefault();

    mouse.x = (event.clientX / window.innerWidth) * 2 - 1;
    mouse.y = -(event.clientY / window.innerHeight) * 2 + 1;

    raycaster.setFromCamera(mouse, camera);

    const intersects = raycaster.intersectObjects(scene.children, true);

    for (let i = 0; i < intersects.length; i++) {
        if (intersects[i].object.userData.url) {
            window.location.href = intersects[i].object.userData.url;
            break;
        }
    }
}

function onDocumentMouseMove(event) {
    event.preventDefault();

    mouse.x = (event.clientX / window.innerWidth) * 2 - 1;
    mouse.y = -(event.clientY / window.innerHeight) * 2 + 1;

    raycaster.setFromCamera(mouse, camera);

    const intersects = raycaster.intersectObjects(scene.children, true);
    let cursorStyle = 'default';

    for (let i = 0; i < intersects.length; i++) {
        if (intersects[i].object instanceof THREE.Mesh) {
            cursorStyle = 'pointer';
            break;
        }
    }

    document.body.style.cursor = cursorStyle;
}

document.addEventListener('mousedown', onDocumentMouseDown, false);
document.addEventListener('mousemove', onDocumentMouseMove, false);

animate();

addEventListener('resize', () => {
    camera.aspect = window.innerWidth / window.innerHeight
    camera.updateProjectionMatrix()
    renderer.setSize(window.innerWidth, window.innerHeight)
})

