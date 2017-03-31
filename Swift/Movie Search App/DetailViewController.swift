//
//  DetailViewController.swift
//  Lab-4
//
//  Created by Cancan Li on 3/9/17.
//  Copyright © 2017 Cancan Li. All rights reserved.
//

import UIKit
import Social

class DetailViewController: UIViewController {
    
    var image: UIImage!
    var theName: String!
    var theScore: String!
    var theRatin: String!
    var theYear: String!
    var ID: String!
    

    @IBOutlet weak var mPoster: UIImageView!
    @IBOutlet weak var date: UILabel!
    @IBOutlet weak var score: UILabel!
    @IBOutlet weak var rating: UILabel!
    
    @IBOutlet weak var navig: UINavigationBar!
    @IBOutlet weak var navitem: UINavigationItem!
    
    
    @IBAction func addFav(_ sender: UIButton) {
        
        if(UserDefaults.standard.stringArray(forKey: "theKey") != nil){
            var array = UserDefaults.standard.stringArray(forKey: "theKey") ?? [String]()
            if (!array.contains(theName)) {
                array.append(theName)
                UserDefaults.standard.set(array,forKey:"theKey")
            }
            else {
                let favAlert = UIAlertController(title: "Oops!", message:
                    "It's already existed!", preferredStyle: UIAlertControllerStyle.alert)
                favAlert.addAction(UIAlertAction(title: "OK", style: UIAlertActionStyle.default,handler: nil))
                self.present(favAlert, animated: true, completion: nil)
            }
        }
        else{
            var array = [String]()
            array.append(theName)
            UserDefaults.standard.set(array,forKey:"theKey")
        }
        
        //this chunk of code if from the tutorial https://www.youtube.com/watch?v=3vMTpBCFljY
        let myAlert = UIAlertController(title: "Success!", message:
            "Successfully Added to Favourite", preferredStyle: UIAlertControllerStyle.alert)
        myAlert.addAction(UIAlertAction(title: "OK", style: UIAlertActionStyle.default,handler: nil))
        self.present(myAlert, animated: true, completion: nil)
    }
    
    
    @IBAction func fbButton(_ sender: UIButton) {
        //the code below is from the website https://www.codementor.io/valsamis/ios-development-facebook-twitter-sharing-du107q81f but I changed the var to let
        
        if SLComposeViewController.isAvailable(forServiceType: SLServiceTypeFacebook) {
            let fbShare:SLComposeViewController = SLComposeViewController(forServiceType: SLServiceTypeFacebook)
            
            self.present(fbShare, animated: true, completion: nil)
            
        } else {
            let alert = UIAlertController(title: "Accounts", message: "Please login to a Facebook account to share.", preferredStyle: UIAlertControllerStyle.alert)
            
            alert.addAction(UIAlertAction(title: "OK", style: UIAlertActionStyle.default, handler: nil))
            self.present(alert, animated: true, completion: nil)
        }
    }
    
    @IBAction func twiBtn(_ sender: UIButton) {
        //the code below is from the website https://www.codementor.io/valsamis/ios-development-facebook-twitter-sharing-du107q81f but I changed the var to let
        
        if SLComposeViewController.isAvailable(forServiceType: SLServiceTypeTwitter) {
            
            let tweetShare:SLComposeViewController = SLComposeViewController(forServiceType: SLServiceTypeTwitter)
            
            self.present(tweetShare, animated: true, completion: nil)
            
        } else {
            
            let alert = UIAlertController(title: "Accounts", message: "Please login to a Twitter account to tweet.", preferredStyle: UIAlertControllerStyle.alert)
            
            alert.addAction(UIAlertAction(title: "OK", style: UIAlertActionStyle.default, handler: nil))
            
            self.present(alert, animated: true, completion: nil)
        }

    }
    
    
    private func getJSON(path: String) -> JSON {
        guard let url = URL(string: path) else { return JSON.null }
        do {
            let data = try Data(contentsOf: url)
            return JSON(data: data)
        } catch {
            return JSON.null
        }
    }
    
    private func fetchData(){
        print(ID)
        let json = getJSON(path: "http://www.omdbapi.com/?i=\(ID!)")
        
        theName = json["Title"].stringValue
        theYear = json["Year"].stringValue
        theScore = json["imdbRating"].stringValue
        theRatin = json["Rated"].stringValue
    }
    
    
    override func viewDidLoad() {
        super.viewDidLoad()
        fetchData()
        
        navitem.title = theName
        
        self.mPoster.image = self.image
        
        date.text = "Released: \(theYear!)"
        score.text = "Score: \(theScore!)"
        rating.text = "Rating: \(theRatin!)"
        // Do any additional setup after loading the view.
    }

    override func didReceiveMemoryWarning() {
        super.didReceiveMemoryWarning()
        // Dispose of any resources that can be recreated.
    }
    

    /*
    // MARK: - Navigation

    // In a storyboard-based application, you will often want to do a little preparation before navigation
    override func prepare(for segue: UIStoryboardSegue, sender: Any?) {
        // Get the new view controller using segue.destinationViewController.
        // Pass the selected object to the new view controller.
    }
    */

}
