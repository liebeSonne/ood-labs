package view;

import javax.swing.*;

public class App extends JFrame {
    JPanel mainPanel;
    private JPanel canvasPanel;
    private JPanel instrumentPanel;

    public App() {
        super();

        this.initComponents();
        this.initMenu();

        this.setTitle("Editor Application");
        this.setContentPane(this.mainPanel);
        this.setDefaultCloseOperation(JFrame.EXIT_ON_CLOSE);
        this.pack();
        this.setSize(800, 600);
        this.setVisible(true);
    }

    private void initComponents() {

    }

    private void initMenu() {
        JMenuBar menuBar = new JMenuBar();

        JMenu menuFile = new JMenu("File");
        JMenu menuHome = new JMenu("Home");
        JMenu menuInsert = new JMenu("Insert");
        JMenu menuView = new JMenu("View");
        JMenu menuFormat = new JMenu("Format");

        menuBar.add(menuFile);
        menuBar.add(menuHome);
        menuBar.add(menuInsert);
        menuBar.add(menuView);
        menuBar.add(menuFormat);

        this.setJMenuBar(menuBar);
    }
}
