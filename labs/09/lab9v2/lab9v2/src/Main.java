import document.Document;
import document.DocumentInterface;
import view.App;

import javax.swing.*;

public class Main {
    public static void main(String[] args) {
        DocumentInterface document = new Document();

        JFrame jFrame = new App(document);
        jFrame.setVisible(true);
    }
}