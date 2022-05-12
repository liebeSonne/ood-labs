package view;

import controller.ShapeController;
import controller.ShapeControllerInterface;
import shape.group.GroupShape;

import javax.swing.*;
import java.awt.*;
import java.awt.event.ActionEvent;
import java.awt.event.ActionListener;

public class App extends JFrame {
    JPanel mainPanel;
    private JPanel canvasPanel;
    private JPanel instrumentPanel;
    private JButton rectangleButton;
    private JButton triangleButton;
    private JButton ellipseButton;
    private JButton UPDButton;

    ShapeControllerInterface controller;
    GroupShape group;

    public App() {
        super();

        this.initFrame();
        this.initShapes();
        this.initComponents();
        this.initMenu();
    }

    private void initFrame() {
        this.setTitle("Editor Application");
        this.setContentPane(this.mainPanel);
        this.setDefaultCloseOperation(JFrame.EXIT_ON_CLOSE);
        this.pack();
        this.setSize(800, 700);
        this.setVisible(true);
    }

    private void initShapes() {
        Point center = new Point(this.canvasPanel.getWidth() /2, this.canvasPanel.getHeight() / 2);
        this.group = new GroupShape();
        this.controller = new ShapeController(center, group);
        ((CanvasPanel)this.canvasPanel).setGroup(this.group);
    }

    private void initComponents() {
        this.bindBtnEvents();
    }

    private void initMenu() {
        JMenuBar menuBar = new MenuBar(this.controller);
        this.setJMenuBar(menuBar);
    }

    private void bindBtnEvents() {
        this.rectangleButton.addActionListener(new ActionListener() {
            @Override
            public void actionPerformed(ActionEvent e) {
                controller.addRectangle();
                drawCanvas();
            }
        });
        this.triangleButton.addActionListener(new ActionListener() {
            @Override
            public void actionPerformed(ActionEvent e) {
                controller.addTriangle();
                drawCanvas();
            }
        });
        this.ellipseButton.addActionListener(new ActionListener() {
            @Override
            public void actionPerformed(ActionEvent e) {
                controller.addEllipse();
                drawCanvas();
            }
        });

        UPDButton.addActionListener(new ActionListener() {
            @Override
            public void actionPerformed(ActionEvent e) {
                drawCanvas();
            }
        });
    }

    private void drawCanvas() {
        canvasPanel.paintComponents(canvasPanel.getGraphics());
    }

    private void createUIComponents() {
        this.canvasPanel = new CanvasPanel();
    }
}
