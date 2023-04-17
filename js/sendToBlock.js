const contractABI = [
    {
      "type": "function",
      "name": "campaigns",
      "inputs": [
        {
          "type": "uint256",
          "name": "",
          "internalType": "uint256"
        }
      ],
      "outputs": [
        {
          "type": "address",
          "name": "owner",
          "internalType": "address"
        },
        {
          "type": "string",
          "name": "title",
          "internalType": "string"
        },
        {
          "type": "string",
          "name": "description",
          "internalType": "string"
        },
        {
          "type": "uint256",
          "name": "target",
          "internalType": "uint256"
        },
        {
          "type": "uint256",
          "name": "deadline",
          "internalType": "uint256"
        },
        {
          "type": "uint256",
          "name": "amountCollected",
          "internalType": "uint256"
        },
        {
          "type": "string",
          "name": "image",
          "internalType": "string"
        }
      ],
      "stateMutability": "view"
    },
    {
      "type": "function",
      "name": "createCampaign",
      "inputs": [
        {
          "type": "address",
          "name": "_owner",
          "internalType": "address"
        },
        {
          "type": "string",
          "name": "_title",
          "internalType": "string"
        },
        {
          "type": "string",
          "name": "_description",
          "internalType": "string"
        },
        {
          "type": "uint256",
          "name": "_target",
          "internalType": "uint256"
        },
        {
          "type": "uint256",
          "name": "_deadline",
          "internalType": "uint256"
        },
        {
          "type": "string",
          "name": "_image",
          "internalType": "string"
        }
      ],
      "outputs": [
        {
          "type": "uint256",
          "name": "",
          "internalType": "uint256"
        }
      ],
      "stateMutability": "nonpayable"
    },
    {
      "type": "function",
      "name": "donateToCampaign",
      "inputs": [
        {
          "type": "uint256",
          "name": "_id",
          "internalType": "uint256"
        }
      ],
      "outputs": [],
      "stateMutability": "payable"
    },
    {
      "type": "function",
      "name": "getCampaigns",
      "inputs": [],
      "outputs": [
        {
          "type": "tuple[]",
          "name": "",
          "components": [
            {
              "type": "address",
              "name": "owner",
              "internalType": "address"
            },
            {
              "type": "string",
              "name": "title",
              "internalType": "string"
            },
            {
              "type": "string",
              "name": "description",
              "internalType": "string"
            },
            {
              "type": "uint256",
              "name": "target",
              "internalType": "uint256"
            },
            {
              "type": "uint256",
              "name": "deadline",
              "internalType": "uint256"
            },
            {
              "type": "uint256",
              "name": "amountCollected",
              "internalType": "uint256"
            },
            {
              "type": "string",
              "name": "image",
              "internalType": "string"
            },
            {
              "type": "address[]",
              "name": "donators",
              "internalType": "address[]"
            },
            {
              "type": "uint256[]",
              "name": "donations",
              "internalType": "uint256[]"
            }
          ],
          "internalType": "struct CrowdFunding.Campaign[]"
        }
      ],
      "stateMutability": "view"
    },
    {
      "type": "function",
      "name": "getDonators",
      "inputs": [
        {
          "type": "uint256",
          "name": "_id",
          "internalType": "uint256"
        }
      ],
      "outputs": [
        {
          "type": "address[]",
          "name": "",
          "internalType": "address[]"
        },
        {
          "type": "uint256[]",
          "name": "",
          "internalType": "uint256[]"
        }
      ],
      "stateMutability": "view"
    },
    {
      "type": "function",
      "name": "numberOfCampaigns",
      "inputs": [],
      "outputs": [
        {
          "type": "uint256",
          "name": "",
          "internalType": "uint256"
        }
      ],
      "stateMutability": "view"
    }
  ];
const contractAddress = "0x0d1E499faD787d8F2AAb77b43cB217df8d6b11dC";
const web3 = new Web3("https://goerli.infura.io/v3/effac947982241c8b5b2d7aa1ea17801");
const contract = new web3.eth.Contract(contractABI, contractAddress);

// Create a function to connect to the blockchain


document.getElementById("submitToBlockchain").addEventListener("click", async () => {
    try {
        const accounts = await web3.eth.getAccounts();
        const from = accounts[0];
        const title = "<?= $project['title'] ?>";
        const description = "<?= $project['description'] ?>";
        const target = "<?= $project['target'] ?>";
        const deadline = "<?= $project['deadline'] ?>";
        const image = ""; // Vous devez ajouter une URL d'image pour votre projet

        const result = await contract.methods
            .createCampaign(from, title, description, target, deadline, image)
            .send({ from });

        console.log("Projet soumis avec succès:", result);
    } catch (error) {
        console.error("Une erreur s'est produite lors de la soumission du projet:", error);
    }
});

