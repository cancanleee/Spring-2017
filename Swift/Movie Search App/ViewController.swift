//
//  ViewController.swift
//  Lab-4
//
//  Created by Cancan Li on 3/9/17.
//  Copyright © 2017 Cancan Li. All rights reserved.
//

import UIKit

class ViewController: UIViewController, UICollectionViewDataSource, UICollectionViewDelegate,UISearchBarDelegate {
    
    var imdbID: String!
    var input: String!
    var thePoster: UIImage!
    var mArray: [Movie] = []
    var imageCache: [UIImage] = []
    
    var activityIndicator: UIActivityIndicatorView = UIActivityIndicatorView(frame:CGRect(x: 0, y: 0, width: 50, height: 50))

   
    @IBOutlet weak var search: UISearchBar!
    @IBOutlet weak var collections: UICollectionView!
    @IBOutlet weak var naviga: UINavigationItem!
    
    
    private func getJSON(path: String) -> JSON {
        guard let url = URL(string: path) else {
            print("fail open url")
            return JSON.null }
        do {
            let data = try Data(contentsOf: url)
            return JSON(data: data)
        } catch {
            return JSON.null
        }
    }
    
    
    func searchBarSearchButtonClicked(_ searchBar: UISearchBar) {
        
        print("aaaaaaaaaaaaaaaaaaaaaaaaaaaaatest")
        
        mArray.removeAll()
        imageCache.removeAll()
        //input = search.text!
        
        //this chunk of code are from the tutorial https://www.youtube.com/watch?v=dLfOdObZW7k
        activityIndicator.center = self.view.center
        activityIndicator.hidesWhenStopped=true
        activityIndicator.activityIndicatorViewStyle=UIActivityIndicatorViewStyle.gray
        activityIndicator.startAnimating()
        view.addSubview(activityIndicator)
        
        DispatchQueue.global(qos: .userInitiated).async {
            self.fetchData(t: self.search.text!)

            DispatchQueue.main.async {
                self.activityIndicator.stopAnimating()
                self.collections.reloadData()
            }
        }
    }
    
    
    private func fetchData(t:String){
        
        let jsonLeft = getJSON(path: "http://www.omdbapi.com/?s=\(t)&y=&plot=short&r=json")
        print(jsonLeft)
        let jsonRight = getJSON(path: "http://www.omdbapi.com/?s=\(t)&y=&plot=short&r=json&page=2")
        print(jsonRight)
        
        for result in jsonLeft["Search"].arrayValue{
            var m = Movie()
            m.poster = result["Poster"].stringValue
            m.title = result["Title"].stringValue
            m.id = result["imdbID"].stringValue
            m.type = result["Type"].stringValue
            m.year = result["Year"].stringValue
            mArray.append(m)
        }
        
        for result in jsonRight["Search"].arrayValue{
            var m = Movie()
            m.poster = result["Poster"].stringValue
            m.title = result["Title"].stringValue
            m.id = result["imdbID"].stringValue
            m.type = result["Type"].stringValue
            m.year = result["Year"].stringValue
            mArray.append(m)
        }
        catcheImages()
    }
    
    
    private func catcheImages(){
        
        for item in mArray{
            let url = URL(string: item.poster!)
            let data = try? Data(contentsOf: url!)
            let image = UIImage(data: data!)
            imageCache.append(image!)
        }
    }
    
    func collectionView(_ collectionView: UICollectionView, cellForItemAt indexPath: IndexPath) -> UICollectionViewCell {
        
        //this line of code if from the tutorial https://www.youtube.com/watch?v=JbPc62YWhPQ
        let cell = collections.dequeueReusableCell(withReuseIdentifier: "mycell", for: indexPath) as! CollectionViewCell
        
        cell.title.text = mArray[indexPath.row].title
        cell.poster.image = imageCache[indexPath.row]
        
        return cell
    }
    
    
    func numberOfSections(in collectionView: UICollectionView) -> Int {
        return 1
    }
    
    
    func collectionView(_ collectionView: UICollectionView, numberOfItemsInSection section: Int) -> Int {
        return imageCache.count
        
    }
    
    func collectionView(_ collectionView: UICollectionView, didSelectItemAt indexPath: IndexPath) {
        let cell = collections.dequeueReusableCell(withReuseIdentifier: "mycell", for: indexPath) as! CollectionViewCell
        
        imdbID = mArray[indexPath.row].id
        thePoster = imageCache[indexPath.row]
        
        
        
        self.performSegue(withIdentifier: "imdb", sender: cell)
    }
    
    override func prepare(for segue: UIStoryboardSegue, sender: Any?) {
        
        if segue.identifier == "imdb" {
            let destination = segue.destination as! DetailViewController
            destination.ID = imdbID
            destination.image = thePoster
        }
    }
    

    
    override func viewDidLoad() {
        super.viewDidLoad()
        
        naviga.title = "Movies"
        
        search.delegate = self
        collections.dataSource = self
        collections.delegate = self
        // Do any additional setup after loading the view, typically from a nib.
    }

    override func didReceiveMemoryWarning() {
        super.didReceiveMemoryWarning()
        // Dispose of any resources that can be recreated.
    }


}

