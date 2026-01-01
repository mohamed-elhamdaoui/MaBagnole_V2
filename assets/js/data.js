// /assets/js/data.js

const db = {
    vehicles: [
        { id: 1, brand: "Toyota", model: "Camry", category: "Sedan", price: 45, image: "https://images.unsplash.com/photo-1621007947382-bb3c3968e3bb?auto=format&fit=crop&q=80&w=800", description: "Reliable and comfortable sedan.", rating: 4.8 },
        { id: 2, brand: "BMW", model: "X5", category: "SUV", price: 120, image: "https://images.unsplash.com/photo-1556189250-72ba954e606a?auto=format&fit=crop&q=80&w=800", description: "Luxury SUV with premium features.", rating: 5.0 },
        { id: 3, brand: "Ford", model: "Mustang", category: "Sport", price: 150, image: "https://images.unsplash.com/photo-1584345604476-8ec5e12e42dd?auto=format&fit=crop&q=80&w=800", description: "American muscle car experience.", rating: 4.9 },
        { id: 4, brand: "Tesla", model: "Model 3", category: "Electric", price: 90, image: "https://images.unsplash.com/photo-1560958089-b8a1929cea89?auto=format&fit=crop&q=80&w=800", description: "Full electric, autopilot included.", rating: 4.7 },
        { id: 5, brand: "Jeep", model: "Wrangler", category: "Off-Road", price: 110, image: "https://images.unsplash.com/photo-1533473359331-0135ef1b58bf?auto=format&fit=crop&q=80&w=800", description: "Perfect for mountain adventures.", rating: 4.6 }
    ],
    categories: ["Sedan", "SUV", "Sport", "Electric", "Off-Road"],
    reviews: [
        { id: 1, user: "John Doe", text: "Amazing service! The car was clean.", rating: 5 },
        { id: 2, user: "Sarah Smith", text: "Good price, but pickup was slow.", rating: 4 }
    ]
};

// Export to global scope
window.mockDB = db;
















// // /assets/js/data.js
// const vehicles = [
//     {
//         id: 1,
//         brand: "Mercedes-Benz",
//         model: "Classe C",
//         category: "Luxe",
//         price: 150,
//         image: "https://images.unsplash.com/photo-1617788138017-80ad40651399?q=80&w=1000&auto=format&fit=crop",
//         transmission: "Automatique",
//         fuel: "Diesel",
//         seats: 5,
//         rating: 4.8,
//         reviews: 124
//     },
//     {
//         id: 2,
//         brand: "Tesla",
//         model: "Model 3",
//         category: "Électrique",
//         price: 110,
//         image: "https://images.unsplash.com/photo-1560958089-b8a1929cea89?q=80&w=1000&auto=format&fit=crop",
//         transmission: "Automatique",
//         fuel: "Électrique",
//         seats: 5,
//         rating: 4.9,
//         reviews: 89
//     },
//     {
//         id: 3,
//         brand: "Range Rover",
//         model: "Evoque",
//         category: "SUV",
//         price: 180,
//         image: "https://images.unsplash.com/photo-1606016159991-dfe4f2746ad5?q=80&w=1000&auto=format&fit=crop",
//         transmission: "Automatique",
//         fuel: "Hybride",
//         seats: 5,
//         rating: 4.7,
//         reviews: 56
//     },
//     {
//         id: 4,
//         brand: "Fiat",
//         model: "500",
//         category: "Citadine",
//         price: 45,
//         image: "https://images.unsplash.com/photo-1541899481282-d53bffe3c35d?q=80&w=1000&auto=format&fit=crop",
//         transmission: "Manuelle",
//         fuel: "Essence",
//         seats: 4,
//         rating: 4.5,
//         reviews: 210
//     }
// ];
// // Sauvegarde initiale
// if(!localStorage.getItem('vehicles')) localStorage.setItem('vehicles', JSON.stringify(vehicles));